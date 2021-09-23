<?php
    return [       
        App\Core\Route::get( '|^user/login/?$|',                      'Main',                        'getLogin'),
        App\Core\Route::post('|^user/login/?$|',                      'Main',                        'postLogin'),
        App\Core\Route::get( '|^user/logout/?$|',                     'Main',                        'getLogout'),
                 
          
        #App\Core\Route::get('|^user/profile/?$|',                     'UserDashboard',                'index'),
        App\Core\Route::get('|^user/profile/?$|',                     'UserBookManagement',           'books'),
      
      
        App\Core\Route::get( '|^user/authors/?$|',                    'UserAuthorManagement',        'authors'),
        App\Core\Route::get( '|^user/authors/edit/([0-9]+)/?$|',      'UserAuthorManagement',        'getEdit'),
        App\Core\Route::post('|^user/authors/edit/([0-9]+)/?$|',      'UserAuthorManagement',        'postEdit'),
        App\Core\Route::get( '|^user/authors/add/?$|',                'UserAuthorManagement',        'getAdd'),
        App\Core\Route::post('|^user/authors/add/?$|',                'UserAuthorManagement',        'postAdd'),
       
        App\Core\Route::get( '|^user/books/?$|',                      'UserBookManagement',          'books'),
        App\Core\Route::get( '|^user/book/([0-9]+)/?$|',              'UserBookManagement',          'select'),
        App\Core\Route::get( '|^user/books/edit/([0-9]+)/?$|',        'UserBookManagement',          'getEdit'),
        App\Core\Route::post('|^user/books/edit/([0-9]+)/?$|',        'UserBookManagement',          'postEdit'),
        App\Core\Route::get( '|^user/books/add/?$|',                  'UserBookManagement',          'getAdd'),
        App\Core\Route::post('|^user/books/add/?$|',                  'UserBookManagement',          'postAdd'),
        App\Core\Route::post('|^user/search/?$|',                     'UserBookManagement',          'postSearch'),
     
        App\Core\Route::get( '|^user/bookshelves/?$|',                'UserBookshelfManagement',     'bookshelves'),
        App\Core\Route::get( '|^user/bookshelves/edit/([0-9]+)/?$|',  'UserBookshelfManagement',     'getEdit'),
        App\Core\Route::post('|^user/bookshelves/edit/([0-9]+)/?$|',  'UserBookshelfManagement',     'postEdit'),
        App\Core\Route::get( '|^user/bookshelves/add/?$|',            'UserBookshelfManagement',     'getAdd'),
        App\Core\Route::post('|^user/bookshelves/add/?$|',            'UserBookshelfManagement',     'postAdd'),
     
        App\Core\Route::get( '|^user/genres/?$|',                     'UserGenreManagement',         'genres'),
        App\Core\Route::get( '|^user/genres/edit/([0-9]+)/?$|',       'UserGenreManagement',         'getEdit'),
        App\Core\Route::post('|^user/genres/edit/([0-9]+)/?$|',       'UserGenreManagement',         'postEdit'),
        App\Core\Route::get( '|^user/genres/add/?$|',                 'UserGenreManagement',         'getAdd'),
        App\Core\Route::post('|^user/genres/add/?$|',                 'UserGenreManagement',         'postAdd'),
      
        App\Core\Route::get( '|^user/publishers/?$|',                 'UserPublisherManagement',     'publishers'),
        App\Core\Route::get( '|^user/publishers/edit/([0-9]+)/?$|',   'UserPublisherManagement',     'getEdit'),
        App\Core\Route::post('|^user/publishers/edit/([0-9]+)/?$|',   'UserPublisherManagement',     'postEdit'),
        App\Core\Route::get( '|^user/publishers/add/?$|',             'UserPublisherManagement',     'getAdd'),
        App\Core\Route::post('|^user/publishers/add/?$|',             'UserPublisherManagement',     'postAdd'),
      
        App\Core\Route::get( '|^user/rooms/?$|',                      'UserRoomManagement',          'rooms'),
        App\Core\Route::get( '|^user/rooms/edit/([0-9]+)/?$|',        'UserRoomManagement',          'getEdit'),
        App\Core\Route::post('|^user/rooms/edit/([0-9]+)/?$|',        'UserRoomManagement',          'postEdit'),
        App\Core\Route::get( '|^user/rooms/add/?$|',                  'UserRoomManagement',          'getAdd'),
        App\Core\Route::post('|^user/rooms/add/?$|',                  'UserRoomManagement',          'postAdd'),

        App\Core\Route::get('|^user/bookPlacement/?$|',               'UserBookPlacementManagement', 'show'),
        App\Core\Route::get('|^user/bookPlacement/book/([0-9]+)/?$|', 'UserBookPlacementManagement', 'select'),



        App\Core\Route::get( '|^book/([0-9]+)/?$|',                   'Book',                     'select'),
        App\Core\Route::post('|^search/?$|',                          'Book',                     'postSearch'),


        
        #App\Core\Route::get('|^api/book/([0-9]+)/?$|',               'ApiBook',                 'show'),


        
        App\Core\Route::any('#^.*$#', 'Main', 'home')
    ];