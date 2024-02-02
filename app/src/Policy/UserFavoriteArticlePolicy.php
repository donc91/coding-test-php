<?php
namespace App\Policy;

use App\Model\Entity\UserFavoriteArticle;
use Authorization\IdentityInterface;
use Cake\ORM\Locator\LocatorAwareTrait;

class UserFavoriteArticlePolicy
{
  use LocatorAwareTrait;

  public function canFavorite(IdentityInterface $user, UserFavoriteArticle $favorite)
  {
      // User cannot like multiple time
      $query = $this->fetchTable('UserFavoriteArticles')->find();
      $exists = $query->where(['article_id' => $favorite->article_id, 'user_id' => $user->getIdentifier()])->first();
      return !$exists;
  }
}