<?php

namespace App\Command;

use App\Entity\User;
use App\Service\DatabaseService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class CreateSuperUserCommand.
 */
class CreateSuperUserCommand extends Command
{
    /** @var DatabaseService */
    private $databaseService;

    /** @var UserPasswordEncoderInterface */
    private $userPasswordEncoder;

    /**
     * @param DatabaseService $databaseService
     *
     * @required
     */
    public function setDatabaseService(DatabaseService $databaseService): void
    {
        $this->databaseService = $databaseService;
    }

    /**
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     *
     * @required
     */
    public function setUserPasswordEncoder(UserPasswordEncoderInterface $userPasswordEncoder): void
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function configure(): void
    {
        $this
            ->setName('app:create-super-user')
            ->setDescription('Create a superuser.')
            ->setHelp('Create a superuser.')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output): void
    {
        /** @var User $user */
        $user = (new User('admin','admin','admin','admin.admin@admin.com','admin'))
            ->setUsername('admin')
            ->setFirstName('Admin')
            ->setLastName('Adminescu')
            ->setEmail('admin.admin@admin.com')
            ->setPlainPassword('admin')
            ->setRoles([User::ROLE_ADMIN]);
        $user->setPassword($this->userPasswordEncoder->encodePassword($user, $user->getPlainPassword()));

        $this->databaseService->save($user);
    }
}