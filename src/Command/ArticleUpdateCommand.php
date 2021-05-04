<?php

namespace App\Command;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Faker\Factory;
class ArticleUpdateCommand extends Command
{
    protected static $defaultName = 'app:article:update';
    protected static $defaultDescription = 'MAJ all articles titles';
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
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $faker = Factory::create();
        $articles = $this->em->getRepository(Article::class)->findAll();
        foreach ($articles as $article) {
            $article->setTitre($faker->name);
            $article->setDescription($faker->sentence);
            $this->em->persist($article);
            $this->em->flush();
        }
        $io->note(sprintf('MAJ tous les articles OK'));


        $io->success('------------- FIn Traitement ---------------');

        return Command::SUCCESS;
    }
}
