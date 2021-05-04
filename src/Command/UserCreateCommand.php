<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UserCreateCommand extends Command
{
    protected static $defaultName = 'app:user:create';
    protected static $defaultDescription = 'Add a short description for your command';
    private $em;
    public function __construct(?string $name = null, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        parent::__construct($name);
    }
    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('username', InputArgument::REQUIRED, 'username')
            ->addArgument('password', InputArgument::REQUIRED, 'password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');
        $user  = new User();
        $user->setPassword($password);
        $user->setUsername($username);
        $this->em->persist($user);
        $this->em->flush();
        $io->note('User created : ');
        return Command::SUCCESS;
    }
}
