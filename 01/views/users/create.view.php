<?php
require base_path('views/partials/head.php'); ?>
<?php
require base_path('views/partials/banner.php'); ?>


    <main>
        <?php
        // jeśli formularz został wysłany:

        if ($form->isSubmitted()) {
            echo $form->renderMessages();
        } ?>

        <div class="mx-auto max-w-xl px-6 py-6 bg-gray-200 rounded-lg shadow">
            <h1 class="font-bold text-blue-800">
                Formularz dodawania nowego użytkownika
            </h1>
            <?= $form->render($action); ?>
        </div>
    </main>

<?php
require base_path('views/partials/footer.php'); ?>