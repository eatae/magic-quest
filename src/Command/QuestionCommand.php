<?php

namespace App\Command;

use App\Entity\QuestionnaireResult\QuestionnaireResult;
use App\Services\Questionnaire\QuestionnaireService;
use App\Services\QuestionnaireResult\QuestionnaireResultService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question as ConsoleQuestion;

#[AsCommand(
    name: 'app:questions',
    description: 'Answer the questionnaire.',
)]
class QuestionCommand extends Command
{
    public function __construct(
        protected QuestionnaireService $questionnaireService,
        protected QuestionnaireResultService $questionnaireResultService,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setHelp('This command starts the questionnaire.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Start and asc name
        $helper = $this->getHelper('question');
        $confirm = new ConfirmationQuestion('Вы готовы пройти опрос? yes/no: ', false);
        if (!$helper->ask($input, $output, $confirm)) {
            return Command::SUCCESS;
        }

        $consoleQuestion = new ConsoleQuestion('Пожалуйста, введите ваше имя: ', 'NoName');
        $name = $helper->ask($input, $output, $consoleQuestion);

        // Create
        $correct = [];
        $inCorrect = [];
        $questionnaire = $this->questionnaireService->getLastQuestionnaire();
        $questionnaire->reorderQuestions();
        $questionnaireResult = $this->questionnaireResultService->getNewQuestionnaireResult(
            $questionnaire,
            $name
        );

        // Ask
        foreach ($questionnaireResult->getQuestionResults() as $questionResult) {
            $template = $questionResult->getQuestion()->getTemplate();
            $choice = new ChoiceQuestion(
                $template,
                $questionResult->collectArrayAnswerResultsByOrderNumber()
            );
            $choice->setMultiselect(true);
            $choice->setErrorMessage('Выбор %s неправильный!');
            $choice->setAutocompleterCallback(null);

            $output->writeln('');
            $answer = $helper->ask($input, $output, $choice);

            $questionResult->markSelectedAnswerResults(...$answer);

            if ($questionResult->isSuccess()) {
                $correct[$questionResult->getOrderNumber()]['question'] = $template;
                $correct[$questionResult->getOrderNumber()]['answer'] = $answer;
            } else {
                $inCorrect[$questionResult->getOrderNumber()]['question'] = $template;
                $inCorrect[$questionResult->getOrderNumber()]['answer'] = $answer;
            }
        }

        // Show correct
        $output->writeln('Правильные ответы:');
        $output->writeln('------------------');
        foreach ($correct as $item) {
            $output->writeln($item['question'] .' '. implode(', ', $item['answer']));
        }

        // Show incorrect
        $output->writeln('Неправильные ответы:');
        $output->writeln('------------------');
        foreach ($inCorrect as $item) {
            $output->writeln($item['question'] .' '. implode(', ', $item['answer']));
        }

        // Save result
        $this->questionnaireResultService->save($questionnaireResult);

        return Command::SUCCESS;
    }
}
