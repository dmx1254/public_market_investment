<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="icon" href="images/logodesk.png" type="image/png">
    <link rel="stylesheet" href="css/calend.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php include "navbar.php"; ?>
    <main class="content">
        <?php include "sidebar.php"; ?>
        <div class="calendar_container">
            <div class="description">
                <p>
                    Au fil des années, les <span class="highlight">marchés publics marocains</span> ont connu une <span
                        class="highlight-green">croissance</span> significative.
                    Cette <span class="highlight-blue">croissance</span> soutenue a été stimulée par divers facteurs
                    économiques et politiques.
                    La mise en place de politiques de <span class="highlight-red">développement</span> économique et la
                    <span class="highlight-orange">modernisation</span> des infrastructures
                    ont contribué à l'essor du secteur des marchés publics.
                </p>
                <p>
                    Cependant, cette <span class="highlight">croissance</span> n'a pas été uniforme au fil du temps. Des
                    <span class="highlight-yellow">fluctuations</span>
                    ont été observées en raison de facteurs tels que les cycles économiques mondiaux, les changements
                    politiques et les réformes législatives.
                </p>
            </div>
            <div class="chart-container chart-1" style="margin-top: 40px; margin-bottom: 40px;">
                <canvas id="publicMarketsChart"></canvas>
            </div>

            <div class="chart-container chart-2">
                <canvas id="publicMarketsProjectionChart"></canvas>
            </div>
            <!-- <div class="chart-description">
                <p>Ce graphique montre les projections des marchés publics marocains de 2025 à 2030 basées sur la
                    tendance historique.</p>
            </div> -->
            <div id="calendar" class="calendar"></div>
        </div>
    </main>
    <?php include 'mobile-sidebar.php' ?>
    <?php include 'footer.php' ?>
    <script src="js/calendar.js"></script>
</body>

</html>