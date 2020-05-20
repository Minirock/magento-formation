<?php
    namespace Correction\TP1\Console\Command;

    use Symfony\Component\Console\Command\Command;
    use Symfony\Component\Console\Exception\LogicException;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Output\OutputInterface;

    class HelloWorld extends Command{

        protected function configure()
        {
            $this->setName("correctionn:tp1:helloworld")
                ->setDescription("Print Hello world");
        }

        protected function execute(InputInterface $input, OutputInterface $output)
        {
            $output->writeln("<info>Hello World</info>");
        }

    }