<?php

namespace App\Mailable;

use Anddye\Mailer\Mailable;
use User;

class JoinConfirmMailable extends Mailable
{
    protected $user;

    /**
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $this->setSubject('[navy lab] 회원가입 확인 메일');
        $this->setView('emails/join-confirm.twig', [
            'user' => $this->user,
        ]);

        return $this;
    }

}