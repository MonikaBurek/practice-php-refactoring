<html>
<style>
    table {
        width: 80%;
        border-collapse: collapse;
        margin: 20px auto;
        text-align: center;
        font-family: Arial, sans-serif;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    thead tr {
        background-color: #4CAF50;
        color: white;
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }

    tbody tr:hover {
        background-color: #e6f5e6; /* delikatne podświetlenie po najechaniu */
    }
    h2 {
        text-align: center;
    }

     a.button-like {
        background-color: #082567;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        display: inline-block;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        text-align: center;
    }

    a.button-add {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        display: inline-block;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        text-align: center;
    }

    button {
        background-color: #500000;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        display: inline-block;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        text-align: center;
    }

    .actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .actions form {
        margin: 0;
    }



</style>
<body>


<header class="relative bg-white shadow-sm">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900"><?= $heading ?></h1>
    </div>
</header>


<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

            <?= $html ?>

    </div>
</main>
</body>