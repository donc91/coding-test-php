<?php
// src/Controller/ArticlesController.php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\View\JsonView;
use App\Controller\Traits\JsonResponseTrait;

class ArticlesController extends AppController
{
    use JsonResponseTrait;

    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Authorization.Authorization');
    }
    
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // actions public, skipping the authentication check
        $this->Authentication->addUnauthenticatedActions(['index', 'view']);
    }

    public function index()
    {
        $userId = $this->request->getAttribute('identity') ? $this->request->getAttribute('identity')->getIdentifier() : NULL;
        $query = $this->Articles->getArticleFavorites($userId);
        $articles = $this->paginate($query);
        $this->set(compact('articles'));
        $this->viewBuilder()->setOption('serialize', 'articles');
    }

    public function view($id)
    {   
        $article = $this->Articles->get($id, [
            'contain' => ['UserFavoriteArticles']
        ]);
        if (!$article) {
            return $this->setJsonResponse(
                [
                    'errors' => ['Record not found']
                ],
                404
            );
        }
        return $this->setJsonResponse(
            [
                'article' => $article
            ],
            200
        );
    }

    public function add()
    {        
        $this->request->allowMethod(['post']);
        $article = $this->Articles->newEmptyEntity();

        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $this->Authorization->authorize($article);

            // Added: Set the user_id from the session.
            $article->user_id = $this->request->getAttribute('identity')->getIdentifier();

            if ($this->Articles->save($article)) {
                return $this->setJsonResponse(
                    [
                        'article' => $article
                    ],
                    201
                );
            } 
            return $this->setJsonResponse(
                [
                    'errors' => $article->getErrors()
                ],
                422
            );
        }

        return $this->setJsonResponse([
            'error' => true,
            'message' => 'Invalid request!',
        ]);
        
    }

    public function edit($id)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $article = $this->Articles->get($id);
        $this->Authorization->authorize($article);

        $this->Articles->patchEntity($article, $this->request->getData(), [
            // Added: Disable modification of user_id.
            'accessibleFields' => ['user_id' => false]
        ]);
        if ($this->Articles->save($article)) {
            return $this->setJsonResponse(
                [
                    'article' => $article
                ]
            );
        }
        return $this->setJsonResponse(
            [
                'errors' => $article->getErrors()
            ],
            422
        );
    }

    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $article = $this->Articles->get($id);
        $this->Authorization->authorize($article);

        if ($this->Articles->delete($article)) {
            return $this->setJsonResponse([
                'message' => __('The post has been deleted.')
            ]);
        }
        return $this->setJsonResponse(
            [
                'error' => true,
                'message' => 'The article could not be deleted. Please, try again.',
            ],
            422
        );
    }

    public function favorite($id)
    {
        $this->request->allowMethod(['post']);

        $article = $this->Articles->get($id);
        if (!$article) {
            return $this->setJsonResponse(
                [
                    'errors' => ['Record not found']
                ],
                404
            );
        }

        $favouriteTable = $this->getTableLocator()->get('UserFavoriteArticles');
        $favorite = $favouriteTable->newEmptyEntity();

        // Added: Set the user_id from the session.
        $favorite->user_id = $this->request->getAttribute('identity')->getIdentifier();
        $favorite->article_id = $id;

        $this->Authorization->authorize($favorite);

        if ($favouriteTable->save($favorite)) {
            return $this->setJsonResponse(
                [
                    'article' => $article
                ],
                201
            );
        } 
        return $this->setJsonResponse(
            [
                'errors' => $favorite->getErrors()
            ],
            422
        );
    }
}