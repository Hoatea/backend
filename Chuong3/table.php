<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table</title>
    <style>
    .chan{
        background: #ddd;
    }
    </style>
</head>
<body>
    <?php
        echo '<h1>Table bằng PHP</h1>';
        echo '<table border="1">';
        for($i=0; $i<4; $i++){
            if(($i%2)==1){
                echo '<tr class="chan">';
            }
            else {
                echo '<tr>';
            }
            for($j=0; $j<5; $j++){
                echo '<td>';
                echo "Dòng {$i}, Cột {$j}";
                echo '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    ?>
    <h1>Table bằng PHP và HTLM</h1>
    <table border="1">
        <?php for($i=0; $i<4; $i++): ?>
            <?php if(($i%2)==1): ?>
            <tr class="chan">
            <?php else: ?>
            <tr>
            <?php endif; ?>
                <?php for($j=0; $j<5; $j++): ?>
                    <td>
                        <?php echo "Dòng {$i}, Cột {$j}"; ?>
                    </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>
</body>
</html>