<?php
$title = "";
$tabela = "";
 switch ($arr[3]) {
  case "artist": $tabela = "artists"; $title = "Artysci"; break;
  case "publisher": $tabela = "publishers"; $title = "Wydawcy"; break;
  case "format": $tabela = "media_types"; $title = "Format"; break;
  case "media": $tabela = "media_states"; $title = "Stan nosnika"; break;
  case "sleeve": $tabela = "sleeve_states"; $title = "Stan okladki"; break;
  case "": $tabela = ""; $title = ""; break;
  default:  break;
}
?>

<div class="container">
        <div class="row alert alert-info">
            <div class="col-md-6">
                <select id="select_list">
                    <option value="">Wybierz kategorie</option>
                    <option value="artist">Artysta</option>
                    <option value="publisher">Wydawca</option>
                    <option value="format">Format</option>
                    <option value="media">Stan nosnika</option>
                    <option value="sleeve">Stan okladki</option>
                </select>
                <button type="button" id="edit_button" class="btn btn-info btn-lg">Przejdz do edycji</button>
            </div>
            <div class="col-md-6">
                <a class="btn btn-primary btn-lg pull-right" href="/~overmind/home">Wroc do listy</a>
                <span id="statusMsg" class=""><?php echo $title;?></span>
            </div>
        </div>
    </div>
</div>

<script>

$(function() {
    $('#edit_button').click(function() {
        var redirectUrl = $('#select_list option:selected').val();
        window.location.href = "/~overmind/categories/" + redirectUrl;
        console.log(redirectUrl);
   });
});

</script>

<div class="container">
    <table id="records_table" class="table table-bordered text-center">
        <thead>
            <tr><th>#</th><th><?php echo $title;?> </th></tr>
        </thead>
<tbody>
<?php
    $sql = "SELECT * FROM ".$tabela;
    $result = mysql_db_query(DB_NAME, $sql, $link);

$lp = 1;
if ($result && mysql_num_rows($result) > 0) {
   while ($row = mysql_fetch_array($result)) {

echo "<tr>";
echo "<td>".$lp."</td>";
echo "<td>".$row["value"]."</td>";
echo "</tr>";
$lp++;
   }
}
?>
</tbody>
</table>