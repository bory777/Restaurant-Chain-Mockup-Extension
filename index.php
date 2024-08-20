<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Generate Users</title>
</head>
<body>
    <form action="download.php" method="post">
        <h2>Input form</h2>
        <!-- 従業員数 -->
        <label for="numberEmployees">Number of Employees:</label>
        <input type="number" id="numberEmployees" name="numberEmployees" min="1" max="10" value="5"><br><br>
        
        <!-- 給料の範囲 -->
         <div class="d-flex">
             <label for="salary">Salary of Employees:</label>
            <div>
                <input type="number" id="minSalary" name="minSalary" min="1" max="100" value="20">
            </div>
             <div>~</div>
             <div>
                 <input type="number" id="maxSalary" name="maxSalary" min="1" max="100" value="50"><br><br>
             </div>
         </div>
        
        <!-- 場所 -->
        <label for="numberLocations">Number of locations:</label>
        <input type="number" id="numberLocations" name="numberLocations" min="1" max="5" value="3"><br><br>
        
        <!-- 郵便番号 -->
        <div class="d-flex">
            <label for="zipCode">ZipCode:</label>
            <div>
                <input type="number" id="minZipCode" name="minZipCode" min="1" max="50" value="10">
            </div>
            <div>~</div>
            <div>
                <input type="number" id="maxZipCode" name="maxZipCode" min="1" max="50" value="20"><br><br>
            </div>
        </div>

        <!-- 出力形式 -->
        <label for="format">Download Format:</label>
        <select id="format" name="format">
            <option value="html">HTML</option>
            <option value="markdown">Markdown</option>
            <option value="json">JSON</option>
            <option value="txt">Text</option>
        </select>

        <button type="submit">Generate</button>
    </form>
</body>
</html>