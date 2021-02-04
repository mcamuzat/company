<?php

namespace App\Command;

use App\Entity\JuridicForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AddFormJuridiqueCommand extends Command
{
    protected static $defaultName = 'app:add-form-juridique';

    public function __construct(EntityManagerInterface $em)
    {

        $this->em = $em;
        parent::__construct();
    }
    protected function configure()
    {
        $this
            ->setDescription('Charge la liste des formes juridiques ')
            ->addArgument('file', InputArgument::REQUIRED, 'nom du fichier');

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $file = $input->getArgument('file');
        $types = explode("\n", file_get_contents($file));

        $batchSize = 100; $i = 0;

        foreach ($types as $type) {
            $i++;

            $juridicForm = new JuridicForm();
            $juridicForm->setname($type);
           

            $this->em->persist($juridicForm);
            if (($i % $batchSize) === 0) {
                $this->em->flush();
                $this->em->clear(); // Detaches all objects from Doctrine!
            }
        }
        $this->em->flush(); //Persist objects that did not make up an entire batch
        $this->em->clear();
    

        return Command::SUCCESS;
    }
}
