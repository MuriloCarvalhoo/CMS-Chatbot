<?php
// Guard routes for chatbox
Route::prefix('{guard}/chatbox')->group(function () {
    Route::get('chatbox/form/{element}', 'ChatboxResourceController@form');
    Route::resource('chatbox', 'ChatboxResourceController');
});
// Public routes for chatbox
Route::get('/{slug}.html', 'ChatboxPublicController@getChatbox');

if (Trans::isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}',
            'where' => ['trans' => Trans::keys('|')],
        ],
        function () {
            // Guard routes for chatbox
            Route::prefix('{guard}/chatbox')->group(function () {
                Route::get('chatbox/form/{element}', 'ChatboxResourceController@form');
                Route::resource('chatbox', 'ChatboxResourceController');
            });
            // Public routes for chatbox
            Route::get('/{slug}.html', 'ChatboxPublicController@getChatbox');
        }
    );
}
