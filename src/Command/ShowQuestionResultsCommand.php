<?php

namespace App\Command;

use App\Entity\QuestionnaireResult\QuestionnaireResult;
use App\Services\QuestionnaireResult\QuestionnaireResultService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:result',
    description: 'Show QuestionResults',
)]
class ShowQuestionResultsCommand extends Command
{
    public function __construct(
        protected QuestionnaireResultService $questionResultService,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setHelp('This command show Results');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $questionnaireResults = $this->questionResultService->getQuestionResults();

        /** @var QuestionnaireResult $questionnaireResult */
        foreach ($questionnaireResults as $questionnaireResult) {
            $output->writeln('');
            $output->writeln('RESULT_ID: ' . $questionnaireResult->getId());
            $output->writeln('-------------');
            $output->writeln('');
            $output->writeln('user_name: ' . $questionnaireResult->getUserName());
            $output->writeln('');
            foreach ($questionnaireResult->getQuestionResults() as $questionResult) {
                $output->writeln('question_result_id: '.$questionResult->getId());
                $answerSuccess = $questionResult->isSuccess() ? 'true' : 'false';
                $output->writeln('is_success: '.$answerSuccess);
                $output->writeln('');
            }
            $output->writeln('');
            $output->writeln('');

        }

        return Command::SUCCESS;
    }
}
