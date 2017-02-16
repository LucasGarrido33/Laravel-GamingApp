<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function createOrGetSocialAccountUser(ProviderUser $providerUser , $providerName)
    {
        //Recherche d'un socialAccount avec ce socialUserId
        $account = SocialAccount::whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        }
        //s'il n'y a pas de social account on cherche si l'utilisateur existe quand même.
        else {
            $user = User::whereEmail($providerUser->getEmail())->first();

            //s'il existe on associe le social account à l'user.
            if ($user) {
                $account = new SocialAccount([
                    'provider_user_id' => $providerUser->getId(),
                    'provider' => $providerName
                ]);

                $account->user()->associate($user);
                $account->save();
            }
            return $user;
        }
    }
}
