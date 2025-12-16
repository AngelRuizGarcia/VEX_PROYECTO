<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>UPLOAD GAME</h1>

    <form action="registrarUsuario.php" method="post">

        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="Introduce the game title..." required>

        <br>

        <label for="releaseStatus">Release Status</label>
        <select name="releaseStatus" id="releaseStatus" required>
            <option value="released">Released</option>
            <option value="developing">Developing</option>
            <option value="draft">Draft</option>
        </select>

        <br>

        <label for="pricing">Pricing</label><br>
        <input type="radio" name="pricing" id="donate" value="Donate" required>
        <label for="pricing">Donate</label>

        <input type="radio" name="pricing" id="paid" value="Paid" required>
        <label for="pricing">Paid</label>

        <input type="radio" name="pricing" id="free" value="Free" required>
        <label for="pricing">Free</label>

        <br>
        <!-- Si le da a donation se muestra esto-->
        <div hidden>
            <label for="donation">Suggested donation: </label>
            <input type="number" name="donation" id="donation">
        </div>
        <!-- Si le da a paid se muestra esto-->
        <div hidden>
            <label for="donation">Price: </label>
            <input type="number" name="price" id="price">
        </div>

        <br>

        <label for="gameFile">Upload game file</label>
        <input type="file" name="gameFile" id="gameFile"><br>
        <label for="fileSize">File size limit: 10GB</label>

        <br>

        <label for="description">Description</label><br>
        <textarea name="description" id="description" rows="5"></textarea>

        <br>

        <label for="genre">Genre</label><br>
        <select name="genre[]" id="genre" multiple>
            <!-- Generar las opciones con la tabla de generos de la BD-->
            <option value="ejemplo">Ejemplo</option>
        </select>

        <br>

        <label for="tags">Tags</label><br>
        <select name="tags[]" id="tags" multiple>
            <!-- Generar las opciones con la tabla de tags de la BD-->
            <option value="ejemplo">Ejemplo</option>
        </select>

        <br>

        <label for="coverImage">Cover image</label>
        <input type="file" name="coverImage" id="coverImage"><br>
        <label for="coverImageResolution">Minimum: aXa, Recommended: aXa</label>

        <br>

        <label for="screenshots">Screenshots</label>
        <input type="file" name="screenshots[]" id="screenshots" multiple><br>
        <label for="screenshotsCount">Minimum: 3, Recommended: 5</label>

        <br>

        <input type="submit" value="Upload Game">
    </form>
</body>

</html>