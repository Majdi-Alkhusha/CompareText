<?php
require_once 'libraryFile.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        form {
            border: 3px solid #f1f1f1;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .submitButton {
            background-color: #2196f3;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        .submitButton:hover {
            opacity: 0.8;
        }

        .container {
            padding: 16px;
        }

        .tabContent {
            display: block;
            width: 80%;
            margin: 0 auto;
            transition: 3s
        }

        .hideTabContent {
            display: none;
            transition: 3s;
        }

        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            width: 80%;
            margin: 0 auto;
        }

        .tab .section {
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
            color: #000;
            background-color: #f1f1f1;
            width: 50%
        }

        .tab .section.active {
            background-color: #ccc;
        }

        .tabActiveStyle {
            background-color: #ccc !important;
        }

    </style>

</head>

<body>
    <div class="tab">
        <button id="hammingTab" class="section tabActiveStyle" onclick="openSection(event, 'hamming')">Hamming</button>
        <button id="levenTab" class="section" onclick="openSection(event, 'leven')">Levenshtein</button>
    </div>
    <div id="hamming" class="tabContent">
        <form method="get">
            <h1>Hamming</h1>

            <div class="container">
                <label for="first"><b>First Text</b></label>
                <input type="text" placeholder="Enter First Text" name="firstH" id="firstH" value="<?php echo (isset($_GET['firstH'])) ? $_GET['firstH'] : ''; ?>" required>

                <label for="second"><b>Second Text</b></label>
                <input type="text" placeholder="Enter Second Text" name="secondH" id="secondH" value="<?php echo (isset($_GET['secondH'])) ? $_GET['secondH'] : ''; ?>" required>
                <input type="hidden" name="type" value="hamming" required>
                <button type="submit" class="submitButton">Submit</button>
            </div>
        </form>
        <button class="submitButton" onClick="FunctionHamming()">Submit with Javascript to see Array (Hamming) in Console</button>
    </div>

    <div id="leven" class="tabContent" style="display:none">
    <form method="get">
            <h1> Levenshtein</h1>
            <div class="container">
                <label for="first"><b>First Text</b></label>
                <input type="text" placeholder="Enter First Text" name="firstL" id="firstL" value="<?php echo (isset($_GET['firstL'])) ? $_GET['firstL'] : ''; ?>" required>

                <label for="second"><b>Second Text</b></label>
                <input type="text" placeholder="Enter Second Text" name="secondL" id="secondL" value="<?php echo (isset($_GET['firstL'])) ? $_GET['secondL'] : ''; ?>" required>
                <input type="hidden" name="type" value="leven" required>
                <button type="submit" class="submitButton">Submit</button>
            </div>
        </form>
        <button class="submitButton" onClick="FunctionLevenshtein()">Submit with Javascript to see Array (Levenshtein) in Console</button>
    </div>
    <script>
        function openSection(evt, animName) {
            var i, x, tablinks;
            x = document.getElementsByClassName("tabContent");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("section");
            for (i = 0; i < x.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" tabActiveStyle", "");
            }
            document.getElementById(animName).style.display = "block";
            evt.currentTarget.className += " tabActiveStyle";
            localStorage.setItem('activeTab', animName);
            localStorage.setItem('evt', evt);
        }
    </script>
    <script>
         function FunctionHamming(){
            let a = document.getElementById("firstH").value;
            let b = document.getElementById("secondH").value;
            if(!a || !b){alert("fill the field please"); return false}
            if (a.length !== b.length) {
            console.log('Strings must same length');
            return null;
            }

            let distance = 0;
            let i
        for (i = 0; i < a.length; i += 1) {
            if (a[i] !== b[i]) {
                distance += 1;
               }
         }
         console.log(distance)
        return distance;
         }
        function FunctionLevenshtein(){
            let a = document.getElementById("firstL").value;
            let b = document.getElementById("secondL").value;
            if(!a || !b){alert("fill the field please"); return false}
            if (a.length === 0) return b.length;
            if (b.length === 0) return a.length;

            var matrix = [];
            var i;
             for (i = 0; i <= b.length; i++) {
                matrix[i] = [i];
            }
            var j;
            for (j = 0; j <= a.length; j++) {
                matrix[0][j] = j;
            }

            for (i = 1; i <= b.length; i++) {
                for (j = 1; j <= a.length; j++) {
                    if (b.charAt(i - 1) == a.charAt(j - 1)) {
                        matrix[i][j] = matrix[i - 1][j - 1];
                    } else {
                         matrix[i][j] = Math.min(matrix[i - 1][j - 1] + 1, // substitution/replace ↘
                            Math.min(matrix[i][j - 1] + 1, // insert →
                                matrix[i - 1][j] + 1)); // delete ↓
                    }
                }
            }
            console.log(matrix)
            console.log(matrix[b.length][a.length])
        };
        </script>
        <script>
    document.addEventListener("DOMContentLoaded", ready);
    function ready(){
    if(localStorage.getItem('activeTab')){
        var i, x, tablinks;
    x = document.getElementsByClassName("tabContent");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("section");
    for (i = 0; i < x.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" tabActiveStyle", "");
    }
    document.getElementById(localStorage.getItem('activeTab')).style.display = "block";
    document.getElementById(localStorage.getItem('activeTab')+"Tab").className += " tabActiveStyle";
    }else{
        document.getElementById("hammingTab").click();
    }
}
    </script>
</body>

</html>

<?php

if (isset($_GET['type'])) {
    $typeCalling = $_GET['type'];

    switch ($typeCalling) {
        case "hamming":
            $mc = new Hamming();
            $mc->set_First_Value($_GET['firstH']);
            $mc->set_Second_Value($_GET['secondH']);
            $mc->calling_Function();
            break;
        case "leven":
            $mc = new Levenshtein();
            $mc->set_First_Value($_GET['firstL']);
            $mc->set_Second_Value($_GET['secondL']);
            $mc->calling_Function();
            break;
        default:
            echo "Try again!";
    }

}

?>