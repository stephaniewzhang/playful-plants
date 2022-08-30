<?php
// Plant Records

//initial state
$show_confirmation_sort_filter = False;

// --- sort and filter plants ---
$sort_filter_feedback_class = 'hidden';

// default/initial query parts
$select_join_part = 'SELECT plants.id as "plants.id", plants.plant_name_c as "plants.plant_name_c", plants.plant_name_s as "plants.plant_name_s",  plants.plant_image as "plants.plant_image", plants.hardiness_zone_range as "plants.hardiness_zone_range", plants.constructive_play as "plants.constructive_play", plants.sensory_play as "plants.sensory_play" , plants.physical_play as "plants.physical_play", plants.imaginative_play as "plants.imaginative_play", plants.restorative_play as "plants.restorative_play", plants.expressive_play as "plants.expressive_play" , plants.play_with_rules as "plants.play_with_rules", plants.bio_play as "plants.bio_play", images.extension as "images.extension", classification_tags.classification_id as "classification_tags.classification_id", classifications.classificationname as "classifications.classificationname", detail_tags.detail_id as "detail_tags.detail_id", details.detailname as "details.detailname" FROM plants INNER JOIN images ON (plants.id = images.plant_id) INNER JOIN classification_tags ON (plants.id = classification_tags.plant_id) INNER JOIN classifications ON (classification_tags.classification_id = classifications.id) INNER JOIN detail_tags ON (plants.id = detail_tags.plant_id) INNER JOIN details ON (detail_tags.detail_id = details.id) ';
$where_part = "";
$order_part = "";
$filter_conditions = array();


// sort - alphabetical order based on colloquial vs scientific name
$sort = $_GET["sortby"];
if($sort == "scientific"){
  $order_part = " ORDER BY plants.plant_name_s";
} else {
  // default condition is that $_GET['sort'] == "colloquial"
  $order_part = " ORDER BY plants.plant_name_c";
}

// filter by play type
$filter_constructive = (bool)($_GET['c_play'] ?? NULL);
$filter_sensory = (bool)($_GET['s_play'] ?? NULL);
$filter_physical = (bool)($_GET['p_play'] ?? NULL);
$filter_imaginative = (bool)($_GET['i_play'] ?? NULL);
$filter_restorative =  (bool)($_GET['r_play'] ?? NULL);
$filter_expressive = (bool)($_GET['e_play'] ?? NULL);
$filter_rule = (bool)($_GET['ru_play'] ?? NULL);
$filter_bio = (bool)($_GET['b_play'] ?? NULL);

// filter by classification -- radio buttons because one at a time
$classification_f = $_GET["classification"];
if ($classification_f == "1"){
  array_push($filter_conditions, "(classification_tags.classification_id = 1)");
}
if($classification_f == "2") {
  array_push($filter_conditions, "(classification_tags.classification_id = 2)");
}
if($classification_f == "3") {
  array_push($filter_conditions, "(classification_tags.classification_id = 3)");
}
if($classification_f == "4") {
  array_push($filter_conditions, "(classification_tags.classification_id = 4)");
}
if($classification_f == "5") {
  array_push($filter_conditions, "(classification_tags.classification_id = 5)");
}
if($classification_f == "6") {
  array_push($filter_conditions, "(classification_tags.classification_id = 6)");
}
if($classification_f == "7") {
  array_push($filter_conditions, "(classification_tags.classification_id = 7)");
}

$detail_f = $_GET["detail"];
if ($detail_f == "1"){
  array_push($filter_conditions, "(detail_tags.detail_id = 1)");
}
if($detail_f == "2") {
  array_push($filter_conditions, "(detail_tags.detail_id = 2)");
}
if($detail_f == "3") {
  array_push($filter_conditions, "(detail_tags.detail_id = 3)");
}
if($detail_f == "4") {
  array_push($filter_conditions, "(detail_tags.detail_id = 4)");
}
if($detail_f == "5") {
  array_push($filter_conditions, "(detail_tags.detail_id = 5)");
}

// filter by growth details -- radio buttons because one at a time
$filter_perennial = (bool)($_GET['perennial_1'] ?? NULL);
$filter_annual = (bool)($_GET['annual_2'] ?? NULL);
$filter_fullsun = (bool)($_GET['fullsun_3'] ?? NULL);
$filter_partialshade = (bool)($_GET['partialshade_4'] ?? NULL);
$filter_fullshade = (bool)($_GET['fullshade_5'] ?? NULL);

// sticky_sort
$sticky_colloquial_alph = ($sort == "colloquial"? 'checked':'');
$sticky_scientific_alph = ($sort == "scientific"? 'checked':'');
// sticky_filters play type
$sticky_constructive_play = ($filter_constructive ? 'checked':'');
$sticky_sensory_play = ($filter_sensory ? 'checked':'');
$sticky_physical_play = ($filter_physical ? 'checked':'');
$sticky_imaginative_play = ($filter_imaginative ? 'checked':'');
$sticky_restorative_play =  ($filter_restorative ? 'checked':'');
$sticky_expressive_play = ($filter_expressive ? 'checked':'');
$sticky_rule_play = ($filter_rule ? 'checked':'');
$sticky_bio_play = ($filter_bio ? 'checked':'');
//sticky_class
$sticky_shrub = ($classification_f == "1" ? 'checked':'');
$sticky_grass = ($classification_f == "2" ? 'checked':'');
$sticky_vine = ($classification_f == "3" ? 'checked':'');
$sticky_tree = ($classification_f == "4" ? 'checked':'');
$sticky_flower = ($classification_f == "5" ? 'checked':'');
$sticky_groundcovers = ($classification_f == "6" ? 'checked':'');
$sticky_other = ($classification_f == "7" ? 'checked':'');
//sticky_detail
$sticky_perennial = ($detail_f == "1" ? 'checked':'');
$sticky_annual = ($detail_f == "2" ? 'checked':'');
$sticky_fullsun = ($detail_f == "3" ? 'checked':'');
$sticky_partialshade = ($detail_f == "4" ? 'checked':'');
$sticky_fullshade = ($detail_f == "5" ? 'checked':'');


// build filter query
if ($filter_constructive){
  array_push($filter_conditions, "(plants.constructive_play = 1)");
}

if ($filter_sensory){
  array_push($filter_conditions, "(plants.sensory_play = 1)");
}

if ($filter_physical){
  array_push($filter_conditions, "(plants.physical_play = 1)");
}

if ($filter_imaginative){
  array_push($filter_conditions, "(plants.imaginative_play = 1)");
}

if ($filter_restorative){
  array_push($filter_conditions, "(plants.restorative_play = 1)");
}

if ($filter_expressive){
  array_push($filter_conditions, "(plants.expressive_play = 1)");
}

if ($filter_rule){
  array_push($filter_conditions, "(plants.play_with_rules = 1)");
}

if ($filter_bio){
  array_push($filter_conditions, "(plants.bio_play = 1)");
}

//check filter and append conditions
if (count($filter_conditions)>0){
  $where_part = "WHERE ".implode(" AND ", $filter_conditions);
  $show_confirmation_sort_filter = True;
}

if ($_GET['filter-sort_filter'] && count($filter_conditions) == 0){
  $sort_filter_feedback_class = '';
}


// concatinate final query
$sql_query = $select_join_part.$where_part.' GROUP BY "plants.id"'.$order_part;
// query plants table
$result = exec_sql_query($db, $sql_query);
// get records from query
$records = $result->fetchAll();

// REVISIT!!
//delete button was clicked for a particular plant!!

if (isset($_POST['delete'])){
  $delete_id = ($_POST['delete']);

  $imageresult = exec_sql_query($db, 'SELECT plants.id as "plants.id", plants.plant_image as "plants.plant_image", images.extension as "images.extension" FROM plants INNER JOIN images ON (images.plant_id = plants.id) WHERE ("plants.id" = :id);', array(':id' =>$delete_id));
  $imagerecords = $imageresult ->fetchAll();
  $imagerecord = $imagerecords[0];

  $detail_tags_delete = exec_sql_query($db, 'DELETE FROM detail_tags WHERE (plant_id = :id)', array(':id' =>$delete_id));
  $classification_tags_delete = exec_sql_query($db, 'DELETE FROM classification_tags WHERE (plant_id = :id)', array(':id' =>$delete_id));
  $images_delete = exec_sql_query($db, 'DELETE FROM images WHERE (plant_id = :id)', array(':id' =>$delete_id));
  $plant_delete = exec_sql_query($db, 'DELETE FROM plants WHERE (id = :id)', array(':id' =>$delete_id));
  $image_filepath = "public/uploads/images/".$imagerecord["plants.plant_image"].".".$imagerecord['images.extension'];
  unlink($image_filepath);
  header("Refresh:0");

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="/public/styles/style.css" media="all" />
</head>

<body>
  <?php include('includes/header.php'); ?>
  <div class = "body">
  <div class = "formandtable">

  <div class = "sidebarparts">
  <h4>Sort and Filter </h4>
  <?php if ($show_confirmation_sort_filter) { ?>
          <section class = "confirmation">
              <p>Successfully Sorted and or Filtered Playful Plants!</p>
          </section>
        <?php } ?>
  <form id="sort_filter-form" method="get" action="/" novalidate>
    <div class = filterform>
    <div class="label-input" role="group" aria-labelledby="sort_head">
      <div id="sort_head"><h4> Sort Alphabetically </h4></div>
      <p id="sort_feedback" class="feedback <?php echo $sort_filter_feedback_class; ?>">Please select at least one sort or filter criteria.</p>
    </div>
          <div>
            <div class="label-input">
              <input type="radio" name="sortby" id="sort-c_alphabet" value ="colloquial" <?php echo $sticky_colloquial_alph; ?> />
              <label for="sort-c_alphabet">By Colloquial Name</label>
            </div>
            <div>
              <input type="radio" name="sortby" id="sort-s_alphabet" value ="scientific" <?php echo $sticky_scientific_alph; ?> />
              <label for="sort-s_alphabet">By Scientific Name</label>
            </div>
          </div>
    </div>
      <div>
      <h4> Filter by Play Type </h4>
        <div class="label-input">
            <input type="checkbox" name="c_play" id="filter-c_play" <?php echo $sticky_constructive_play; ?>/>
            <label for="filter-c_play">Constructive Play</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="s_play" id="filter-s_play" <?php echo $sticky_sensory_play; ?>/>
            <label for="filter-s_play">Sensory Play</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="p_play" id="filter-p_play" <?php echo $sticky_physical_play; ?>/>
            <label for="filter-p_play">Physical Play</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="i_play" id="filter-i_play" <?php echo $sticky_imaginative_play; ?>/>
            <label for="filter-i_play">Imaginative Play</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="r_play" id="filter-r_play" <?php echo $sticky_restorative_play; ?>/>
            <label for="filter-r_play">Restorative Play</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="e_play" id="filter-e_play" <?php echo $sticky_expressive_play; ?>/>
            <label for="filter-e_play">Expressive Play</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="ru_play" id="filter-ru_play" <?php echo $sticky_rule_play; ?>/>
            <label for="filter-ru_play">Play with Rules</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="b_play" id="filter-b_play" <?php echo $sticky_bio_play; ?>/>
            <label for="filter-b_play">Bio Play</label>
        </div>
      </div>
      <div>
      <h4> Filter by Plant Classification </h4>
      <div class="label-input" role="group" aria-labelledby="class_head">
        <div class="label-input">
            <input type="radio" name="classification" id="filter-shrub" value = "1" <?php echo $sticky_shrub; ?>/>
            <label for="filter-shrub">Shrub</label>
        </div>
        <div class="label-input">
            <input type="radio" name="classification" id="filter-grass" value = "2" <?php echo $sticky_grass; ?>/>
            <label for="filter-grass">Grass</label>
        </div>
        <div class="label-input">
            <input type="radio" name="classification" id="filter-vine" value = "3" <?php echo $sticky_vine; ?>/>
            <label for="filter-vine">Vine</label>
        </div>
        <div class="label-input">
            <input type="radio" name="classification" id="filter-tree" value = "4" <?php echo $sticky_tree; ?>/>
            <label for="filter-tree">Tree</label>
        </div>
        <div class="label-input">
            <input type="radio" name="classification" id="filter-flower" value = "5" <?php echo $sticky_flower; ?>/>
            <label for="filter-flower">Flower</label>
        </div>
        <div class="label-input">
            <input type="radio" name="classification" id="filter-groundcovers" value = "6" <?php echo $sticky_groundcovers; ?>/>
            <label for="filter-groundcovers">Groundcovers</label>
        </div>
        <div class="label-input">
            <input type="radio" name="classification" id="filter-other" value = "7" <?php echo $sticky_other; ?>/>
            <label for="filter-other">Other [Mosses, Ferns, Vegetables, etc.]</label>
        </div>
        </div>
      <h4> Filter by Plant Growth Details </h4>
      <div class="label-input" role="group" aria-labelledby="detail_head">
        <div class="label-input">
            <input type="radio" name="detail" id="filter-perennial" value = "1"<?php echo $sticky_perennial; ?>/>
            <label for="filter-perennial">Perennial</label>
        </div>
        <div class="label-input">
            <input type="radio" name="detail" id="filter-annual" value = "2" <?php echo $sticky_annual; ?>/>
            <label for="filter-annual">Annual</label>
        </div>
        <div class="label-input">
            <input type="radio" name="detail" id="filter-fullsun" value = "3" <?php echo $sticky_fullsun; ?>/>
            <label for="filter-fullsun">Full Sun</label>
        </div>
        <div class="label-input">
            <input type="radio" name="detail" id="filter-partialshade" value = "4" <?php echo $sticky_partialshade; ?>/>
            <label for="filter-partialshade">Partial Shade</label>
        </div>
        <div class="label-input">
            <input type="radio" name="detail" id="filter-fullshade" value = "5" <?php echo $sticky_fullshade; ?>/>
            <label for="filter-fullshade">Full Shade</label>
        </div>
      </div>
        <br></br>
        <div class="align-right">
            <input id="filter-sort_filter" name = "filter-sort_filter" type="submit" value="Apply Sort or Filter" />
        </div>
      </div>
    </form>
  </div>

    <div class = "table">
      <div class = action_section>
          <h2> Plant Results</h2>
          <p> Click on each gallery item for more details about that plant! <p>
        <div class="right-align print">
            <button onClick="window.print()">Print Table</button>
        </div>
      </div>
      <div class = gallary>
      <?php
      foreach ($records as $record) {
      $p_sql_query = 'SELECT plants.id as "plants.id", plants.plant_name_c as "plants.plant_name_c", plants.plant_name_s as "plants.plant_name_s",  plants.plant_image as "plants.plant_image", plants.hardiness_zone_range as "plants.hardiness_zone_range", plants.constructive_play as "plants.constructive_play", plants.sensory_play as "plants.sensory_play" , plants.physical_play as "plants.physical_play", plants.imaginative_play as "plants.imaginative_play", plants.restorative_play as "plants.restorative_play", plants.expressive_play as "plants.expressive_play" , plants.play_with_rules as "plants.play_with_rules", plants.bio_play as "plants.bio_play", images.extension as "images.extension", classification_tags.classification_id as "classification_tags.classification_id", classifications.classificationname as "classifications.classificationname", detail_tags.detail_id as "detail_tags.detail_id", details.detailname as "details.detailname" FROM plants INNER JOIN images ON (plants.id = images.plant_id) INNER JOIN classification_tags ON (plants.id = classification_tags.plant_id) INNER JOIN classifications ON (classification_tags.classification_id = classifications.id) INNER JOIN detail_tags ON (plants.id = detail_tags.plant_id) INNER JOIN details ON (detail_tags.detail_id = details.id) WHERE ("plants.id" = :id);';

      $p_result = exec_sql_query($db, $p_sql_query, array(':id' => $record["plants.id"]));
      $p_records = $p_result->fetchAll();
      $p_record = $p_records[0];


      //which play type(s) does this plant have?
      $play_type_total = array();
      $p_record["plants.constructive_play"] == 1 ? array_push($play_type_total,'Constructive') : '';
      $p_record["plants.sensory_play"] == 1 ? array_push($play_type_total,'Sensory') : '';
      $p_record["plants.physical_play"] == 1 ? array_push($play_type_total,'Physical') : '';
      $p_record["plants.imaginative_play"] == 1 ? array_push($play_type_total,'Imaginative') : '';
      $p_record["plants.restorative_play"] == 1 ? array_push($play_type_total,'Restorative') : '';
      $p_record["plants.expressive_play"] == 1 ? array_push($play_type_total,'Expressive') : '';
      $p_record["plants.play_with_rules"] == 1 ? array_push($play_type_total,'Rules') : '';
      $p_record["plants.bio_play"] == 1 ? array_push($play_type_total,'Bio') : '';

      if (count($play_type_total)>0){
        $play_type_table = "".implode("<br>", $play_type_total);
      }
      //which classification(s) does this plant have?
      $class_total = array();
      $class_total_num = array();

      foreach ($p_records as $p_record){
        if (!in_array($p_record["classifications.classificationname"], $class_total)){
          array_push($class_total, $p_record["classifications.classificationname"]);
          array_push($class_total_num, $p_record["classification_tags.classification_id"]);
        }
      }

      if (count($class_total)>0){
        $classifications_table = "".implode("<br>", $class_total);
      }

      //which growth detail(s) does this plant have?
      $detail_total = array();

      foreach ($p_records as $p_record){
        if (!in_array($p_record["details.detailname"], $detail_total)){
          array_push($detail_total, $p_record["details.detailname"]);
        }
      }

      if (count($detail_total)>0){
        $details_table = "".implode("<br>", $detail_total);
      }
      ?>

        <div class = gallary_items>
          <?php if (is_user_logged_in() && $is_admin){ ?>
            <div class = 'adminbuttons'>

              <form method = "get" action = "/update">
                <input type = 'hidden' name = "id" value = "<?php echo htmlspecialchars($p_record['plants.id']); ?>">
                  <button class = "align-right" type="submit" title="update <?php echo htmlspecialchars($p_record['plants.plant_name_c']); ?>&apos; records"> Edit </button>
              </form>
              <!-- have hidden inputs form for delete button  -->
              <form method = "post" action = "/" novalidate>
                <input type = 'hidden' name = "delete" value = "<?php echo htmlspecialchars($p_record['plants.id']); ?>">
                  <button class = "align-right" type="submit" title="delete <?php echo htmlspecialchars($p_record['plants.plant_name_c']); ?>&apos; records" onclick="return confirm('Are you sure you want to delete <?php echo $p_record['plants.plant_name_c']?> from the database?')"> Delete </button>
              </form>
            </div>
          <?php } ?>
          <a href="/detailed?<?php echo http_build_query(array('id' => $p_record['plants.id'])); ?>">
              <!-- does the plant's photo exist? if not, use default unknown picture -->
              <?php
                $image_path = "public/uploads/images/".$p_record["plants.plant_image"].".".$p_record['images.extension'];
                // Source: (Instructor provided) Kyle Harms
                $doesimageexist = !file_exists($image_path);

                if (!file_exists($image_path)){ // should the default image be in the upload folder??
                  // Source: (original work) Stephanie Zhang
                  $image_path = "public/uploads/no-image.jpg";
                }
              ?>
              <div class = "gallarycontent">
                <img src=<?php echo htmlspecialchars($image_path); ?> alt="<?php echo htmlspecialchars($p_record["plants.plant_name_c"]); ?>">
                <div class = "gallarytag">
                  <h4><?php echo htmlspecialchars($p_record["plants.plant_name_c"]); ?></h4>
                  <h5><?php echo htmlspecialchars($p_record["plants.plant_name_s"]); ?></h5>
                </div>
                <div class = "gallarytag">
                  <h5> Play Type(s) </h5>
                  <p> <?php echo ($play_type_table); ?> </p>
                </div>
                <div class = "gallarytag">
                  <h5> Classification(s) </h5>
                  <p> <?php echo ($classifications_table); ?> </p>
                </div>
                <div class = "gallarytag">
                  <h5> Growth Detail(s) </h5>
                  <p> <?php echo ($details_table); ?> </p>
                </div>
              </div>
            </a>
        </div>

      <?php } ?>
</body>

</html>
