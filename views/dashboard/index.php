<?php
// En el view en la función render se hace referencia a d como data,
// los datos vienen dados por el controlador dashboard que les pasa los datos como data al view dando origen a 'd'
$expenses               = $this->d['expenses'];
$totalThisMonth         = $this->d['totalAmountThisMonth'];
$maxExpensesThisMonth   = $this->d['maxExpensesThisMonth'];
$user                   = $this->d['user'];
$categories             = $this->d['categories'];

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense App - Dashboard</title>
</head>

<body>
    <?php require 'header.php'; ?>

    <div id="main-container">
        <?php $this->showMessages(); ?>
        <div id="expenses-container" class="container">

            <div id="left-container">
                <!-- Google chart -->
                <div id="chart-container">
                    <div id="chart">

                    </div>
                </div>
                <!-- Expenses data -->
                <div class="expenses-data">
                    <div class="expenses-main">
                        <div class="section-budget-month">
                            <div class="calc-budget">
                                <span class="calc-budget-text">
                                    Presupuesto del mes
                                </span>
                            </div>
                            <div class="calc-budget-number">
                                <?php
                                if ($totalThisMonth === NULL) {
                                } else { ?>
                                    <span>
                                        <?php
                                        $gap = $user->getBudget() - $totalThisMonth;
                                        if ($gap < 0) {
                                            echo '-$';
                                        } else {
                                            echo '$';
                                        }
                                        echo number_format(abs($user->getBudget() - $totalThisMonth), 2);
                                        ?>
                                    </span>
                                <?php } ?>
                            </div>

                            <form action=""></form>
                            <button onclick="window.location.href='<?php echo constant('URL'); ?>user#budget-user-container'" class="btn-main">
                                <i class="material-icons">currency_exchange</i>
                                <span>Definir Presupuesto</span>
                            </button>
                        </div>
                        <div class="section-budget-expenses">
                            <div class="calc-budget-text">
                                <span class="calc-budget-text">
                                    Gastos totales del mes
                                </span>
                            </div>
                            <div class="calc-budget-number">
                                <?php
                                if ($totalThisMonth === NULL) {
                                    echo 'Hubo un problema al cargar la información';
                                } else { ?>
                                    <span class="<?php echo ($user->getBudget() < $totalThisMonth) ? 'broken' : '' ?>">$<?php echo number_format($totalThisMonth, 2); ?></span>
                                <?php } ?>
                            </div>
                            <button class="btn-main" id="new-expense">
                                <i class="material-icons">add</i>
                                <span>Registrar nuevo gasto</span>
                            </button>
                        </div>

                    </div>
                </div>
                <!-- Cards -->
                <div id="expenses-category">
                    <h2>Gastos del mes por categoria</h2>
                    <div id="categories-container">
                        <?php
                        if ($categories === NULL) {
                            echo ('Datos no disponibles por el momento');
                        } else {
                            foreach ($categories as $category) { ?>
                                <div class="card w-30 bs-1" style="background-color: <?php echo $category['category']->getColor() ?>">
                                    <div class="content category-name">
                                        <?php echo $category['category']->getName() ?>
                                    </div>
                                    <div class="title category-total">$<?php echo $category['total'] ?></div>
                                    <div class="content category-count">
                                        <p><?php
                                            $count = $category['count'];
                                            if ($count == 1) {
                                                echo $count . ' transacción';
                                            } else {
                                                echo $count . ' transacciones';
                                            }
                                            ?></p>
                                    </div>
                                </div>
                        <?php    }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div id="right-container">
                <div class="transactions-container">
                    <section id="expenses-recents">
                        <h2>Registros más recientes</h2>
                        <?php
                        if ($expenses === NULL) {
                            ?> <div class="expenses-null">Error al cargar los datos</div> <?php
                        } else if (count($expenses) == 0) {
                            ?> <div class="expenses-null">No hay transacciones</div> <?php
                        } else {
                            foreach ($expenses as $expense) { ?>
                                <div class="preview-expense">
                                    <div class="left">
                                        <div class="expense-date"><?php echo $expense->getDate(); ?></div>
                                        <div class="expense-date"><?php echo $expense->getTitle(); ?></div>
                                    </div>
                                    <div class="right">
                                        <div class="expense-amount">$<?php echo number_format($expense->getAmount(), 2); ?></div>
                                    </div>
                                </div>
                        <?php
                            }
                            echo '<div class="more-container"><a href="expenses">Ver todos los gastos<i class="material-icons">keyboard_arrow_right</i></a></div>';
                        }
                        ?>
                    </section>
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="public/js/dashboard.js"></script>
</body>

</html>