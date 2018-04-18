<?php
function slownik($tempCat, $link) {
    echo "<option value=''>Wybierz...</option>";
        if ($tempCat == "media_states" && "media_types") {
            $sql = "SELECT * FROM ".$tempCat." ORDER BY id ASC";    
        } else {
            $sql = "SELECT * FROM ".$tempCat." ORDER BY value ASC";
        }
        $result = mysql_db_query(DB_NAME, $sql, $link);
            if ($result && mysql_num_rows($result) > 0) {
                while ($row = mysql_fetch_array($result)) {
                    echo "<option value='".$row["id"]."'>".$row["value"]."</option>";
                }
            }
}
?>

<?php
function dateGenerator() {
    echo "<option value=''>Wybierz...</option>";
        for ($i = 1950; $i <= 2020; $i++) {
            echo "<option>$i</option>";
        }
    }
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['formularz'] === 'dodaj') {
        $sql = "INSERT INTO vinyls (`id`, `artist_id`, `publisher_id`, `format_id`, `media_id`, `sleeve_id`, `album`, `year`, `catalogue`) ";
        $sql .= "VALUES (NULL, '".$_POST['in_artysci']."', '".$_POST['in_wydawca']."', '".$_POST['in_format']."', '".$_POST['in_nosnik']."', '".$_POST['in_okladka']."', '".$_POST['in_album']."', '".$_POST['in_rok']."', '".$_POST['in_nrkat']."')";
        $result = mysql_db_query(DB_NAME, $sql, $link);
    }
    if ($_POST['formularz'] === 'modyfikuj') {
        $sql = "UPDATE vinyls SET artist_id = '".mysql_real_escape_string($_POST['in_artysci'])."', `publisher_id` = '".$_POST['in_wydawca']."', `format_id` = '".$_POST['in_format']."', `media_id` = '".$_POST['in_nosnik']."', `sleeve_id` = '".$_POST['in_okladka']."', `album` = '".$_POST['in_album']."', `year` = '".$_POST['in_rok']."', `catalogue` = '".mysql_real_escape_string($_POST['in_nrkat'])."' ";
        $sql .= "WHERE id = ".$_POST['in_db_id']; 
        $result = mysql_db_query(DB_NAME, $sql, $link);
        //echo mysql_real_escape_string($_POST['in_nrkat']);
        //echo "     ".$_POST['in_nrkat'];
    }
    if ($_POST['formularz'] === 'usun') {
        $sql = "DELETE FROM vinyls WHERE id = ".$_POST['usun_pozycje'];
        $result = mysql_db_query(DB_NAME, $sql, $link);
    }
}

?>

<script>
"use strict";

$(function() {
    $('#form_dodaj_edytuj').submit(function(submitEvent) {
    $('#modal_dodaj_edytuj input:text').each(function() {
        var $thiz = $(this);
        if ($thiz.val().length > 0)  {
            $thiz.parent().removeClass('alert alert-danger');
        } else {
            $thiz.parent().addClass('alert alert-danger');
            submitEvent.preventDefault();
        }
    });
    $('#modal_dodaj_edytuj select').each(function() {
        var $thiz = $(this);
        if ($thiz.val().length > 0)  {
            $thiz.parent().removeClass('alert alert-danger');
        } else {
            $thiz.parent().addClass('alert alert-danger');
            submitEvent.preventDefault();
        }
    $('#form_submit_type').attr("value", "modyfikuj");
   });
});

$(function() {
    $('#open_add_edit_modal_button').click(function() {
        $('#add_edit_modal_header_text').text("Dodaj nowa pozycje do bazy danych");
        $('#modal_confirm_button').attr("value", "Dodaj");
        $('#form_submit_type').attr("value", "dodaj");
            $('#modal_dodaj_edytuj input:text').each(function() {
                $(this).val("");
             });
           $('#modal_dodaj_edytuj select').each(function() {
                $(this).val("");
             });
        });
});

$(function () {
    $('.edit-button').click(function() {
    $('#add_edit_modal_header_text').text("Modyfikuj wpis w bazie");
    $('#modal_confirm_button').attr("value", "Modyfikuj");
    $('#form_submit_type').attr("value", "modyfikuj");
    var thiz = $(this);
    var sendId = thiz.attr('db-vinyl-id');
    $('input[name=in_db_id]').val(sendId);
//    var allObjects = thiz.parentsUntil('tbody').children().not('span');
      var allObjects = thiz.parent().parent().children();
      allObjects.each(function() {
          var thiz = $(this);
          if (thiz.attr("db-artist-id")){ $('#form_artysci').val(thiz.attr("db-artist-id")) }
          if (thiz.attr("db-publisher-id")) { $('#form_wydawca').val(thiz.attr("db-publisher-id")) }
          if (thiz.attr("db-format-id")) { $('#form_media').val(thiz.attr("db-format-id")) }
          if (thiz.attr("db-mediastate-id")) { $('#form_nosnik').val(thiz.attr("db-mediastate-id")) }
          if (thiz.attr("db-sleevestate-id")) { $('#form_okladka').val(thiz.attr("db-sleevestate-id")) }
          if (thiz.attr("db-fake-album")) { $('#form_albumy').val(thiz.text()) }
          if (thiz.attr("db-fake-year")) { $('#form_rok').val(thiz.text()) }
          if (thiz.attr("db-fake-cat")) { $('#form_nrkat').val(thiz.text()) }
      });
    $('#modal_dodaj_edytuj').modal('show');
    });
});

$(function() {
    $('.remove-button').click(function() {
        var $thiz = $(this);
        console.log($thiz);
        console.log(this);
        var sendId = $thiz.attr('db-vinyl-id');
        console.log(sendId);
        $('#modal_usun').modal('show');
        $('input[name=usun_pozycje]').val(sendId);
   });
});

});
</script>

<form action="/~overmind/" method="post" id="form_dodaj_edytuj">
<input id="form_submit_type" type="hidden" value="" name="formularz"/>
<input id="db_id" type="hidden" value="" name="in_db_id"/>

<div id="modal_dodaj_edytuj" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 text-center align-middle">
                            <h3 id="add_edit_modal_header_text"></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <label for="in_artysci">Artysci</label>
                            <select id="form_artysci" name="in_artysci" class="form-control">
                            <?php slownik("artists", $link);?>
                            </select>
                        </div>
                        <div class="col-lg-12 form-group">
                            <label for="in_albumy">Album</label>
                            <input id="form_albumy" type="text" name="in_album" class="form-control">
                        </div>
                        <div class="col-lg-12 form-group">
                            <label for="in_rok">Rok</label>
                            <select id="form_rok" name="in_rok" class="form-control">
                            <?php dateGenerator();?>
                            </select>
                        </div>
                        <div class="col-lg-12 form-group">
                            <label for="in_wydawca">Wydawaca</label>
                            <select id="form_wydawca" name="in_wydawca" class="form-control">
                            <?php slownik("publishers", $link);?>
                            </select>
                        </div>
                        <div class="col-lg-12 form-group">
                            <label for="in_nrkat">Numer katalogowy</label>
                            <input id="form_nrkat" type="text" name="in_nrkat" class="form-control">
                        </div>
                        <div class="col-lg-12 form-group">
                            <label for="in_format">Format</label>
                            <select id="form_media" name="in_format" class="form-control" >
                            <?php slownik("media_types", $link);?>
                            </select>
                        </div>
                        <div class="col-lg-12 form-group">
                            <label for="in_nosnik">Nosnik</label>
                            <select  id="form_nosnik" class="form-control" name="in_nosnik">
                            <?php slownik("media_states", $link);?>
                            </select>
                        </div>
                        <div class="col-lg-12 form-grou">
                            <label for="in_okladka">Okladka</label>
                            <select  id="form_okladka" class="form-control" name="in_okladka">
                            <?php slownik("sleeve_states", $link);?>
                            </select>
                        </div>
                        <div class="col-lg-12 modal-footer" >
                            <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Nie</button>
                            <input type="submit" value="Dodaj" id="modal_confirm_button" class="btn btn-success btn-lg">
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Formularz do usuwania pozycji -->

<form action="/~overmind/" method="post">
<input type="hidden" value="usun" name="formularz"/>
<input type="hidden" value="" name="usun_pozycje"/>

<div id="modal_usun" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"></button>
                    <h4 class="modal-title">UWAGA!!!!</h4>
                </div>
                <div class="modal-body">
                    <p>Czy na pewno usunac dana pozycje?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Nie</button>
                    <input type="submit" value="Tak" class="btn btn-success btn-lg">
                </div>
            </div>
        </div>
    </div>
</div>

</form>


<!-- NAGLOWEK I GENEROWANIE TABELKI -->

<div class="container">
        <div class="row alert alert-info">
            <div class="col-md-6">
                <button id="open_add_edit_modal_button"class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal_dodaj_edytuj">Dodaj nowa pozcyje</button>
            </div>
            <div class="col-md-6">
                <a class="btn btn-primary btn-lg pull-right" href="/~overmind/categories">Edytuj kategorie</a>
            </div>
        </div>
    </div>
    <div class="container">
        <table id="records_table" class="table table-bordered text-center">
            <thead> 
                <tr><th>#</th><th>ARTYSTA</th><th>ALBUM</th><th>ROK</th><th>WYDAWCA</th><th>NR KATALOGOWY</th><th>FORMAT</th><th>STAN<br>NOŚNIKA</th><th>STAN<br>OKŁADKI</th><th>EDIT</th></tr>
            </thead>
            <tbody>
<?php
$sql = "SELECT vinyls.id AS id, ";
$sql .= "vinyls.album AS album, ";
$sql .= "vinyls.year AS yr, ";
$sql .= "vinyls.catalogue AS cat, ";
$sql .= "artists.value AS artist, ";
$sql .= "publishers.value AS pub, ";
$sql .= "media_states.value AS media, ";
$sql .= "media_types.value AS format, ";
$sql .= "sleeve_states.value AS sleeve, ";

$sql .= "artists.id AS artist_id, ";
$sql .= "publishers.id AS publisher_id, ";
$sql .= "media_types.id AS format_id, ";
$sql .= "media_states.id AS mediastate_id, ";
$sql .= "sleeve_states.id AS sleevestate_id ";

$sql .= "FROM vinyls ";
$sql .= "LEFT JOIN artists ON vinyls.artist_id = artists.id ";
$sql .= "LEFT JOIN publishers ON vinyls.publisher_id = publishers.id ";
$sql .= "LEFT JOIN media_types ON vinyls.format_id = media_types.id ";
$sql .= "LEFT JOIN media_states ON vinyls.media_id = media_states.id ";
$sql .= "LEFT JOIN sleeve_states ON vinyls.sleeve_id = sleeve_states.id ";

// echo $sql;

$result = mysql_db_query(DB_NAME, $sql, $link);

$lp = 1;
if ($result && mysql_num_rows($result) > 0) {
    while ($row = mysql_fetch_array($result)) {
        echo "<tr>";
        echo "<td db-id=".$row["id"].">".$lp."</td>";
        echo "<td db-artist-id=".$row["artist_id"].">".$row["artist"]."</td>";
        echo "<td db-fake-album=\"1\">".$row["album"]."</td>";
        echo "<td db-fake-year=\"1\">".$row["yr"]."</td>";
        echo "<td db-publisher-id=".$row["publisher_id"].">".$row["pub"]."</td>";
        echo "<td db-fake-cat=\"1\">".$row["cat"]."</td>";
        echo "<td db-format-id=".$row["format_id"].">".$row["format"]."</td>";
        echo "<td db-mediastate-id=".$row["mediastate_id"].">".$row["media"]."</td>";
        echo "<td db-sleevestate-id=".$row["sleevestate_id"].">".$row["sleeve"]."</td>";
        echo "<td><span class=\"glyphicon glyphicon-edit my-green edit-button\" db-vinyl-id=".$row["id"]."></span>";
        echo "<span class=\"glyphicon glyphicon-remove my-red remove-button\" db-vinyl-id=".$row["id"]."></span></td>";
        echo "</tr>";
$lp++;
    }
}
?>
            </tbody>
        </table>
    </div>