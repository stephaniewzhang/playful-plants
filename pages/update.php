<?php

//set max file size for upload
define("max_size", 10000000);

// values - form
$colloquial_name = null;
$scientific_name = null;

$image_id = null;
$hardiness = null;

$constructive_play = null;
$sensory_play = null;
$physical_play = null;
$imaginative_play = null;
$restorative_play = null;
$expressive_play = null;
$rule_play = null;
$bio_play = null;

$shrub = null;
$grass = null;
$vine = null;
$tree = null;
$flower = null;
$groundcovers = null;
$other = null;

$perennial = null;
$annual = null;
$fullsun = null;
$partialshade = null;
$fullshade = null;

// sticky values - form
$sticky_colloquial_name = '';
$sticky_scientific_name = '';

$sticky_image_id = '';
$sticky_hardiness = '';

$sticky_constructive_play = '';
$sticky_sensory_play = '';
$sticky_physical_play = '';
$sticky_imaginative_play = '';
$sticky_restorative_play = '';
$sticky_expressive_play = '';
$sticky_rule_play = '';
$sticky_bio_play = '';

$sticky_shrub = '';
$sticky_grass = '';
$sticky_vine = '';
$sticky_tree = '';
$sticky_flower = '';
$sticky_groundcovers = '';
$sticky_other = '';

$sticky_perennial = '';
$sticky_annual = '';
$sticky_fullsun = '';
$sticky_partialshade = '';
$sticky_fullshade = '';

$update_plant = $_POST['update-plant'] ?? NULL; // called only if the edit form is submitted
//when the form is submitted for editing, the $detailed_id is null
$detailed_id = $_GET['id'] ?? NULL; // load current plant information --> i can't retrieve this variable when I submit the form to change the attributes of this !!

// get info from the updated version
if ($update_plant) {
  $records = exec_sql_query(
    $db,
    'SELECT plants.id as "plants.id", plants.plant_name_c as "plants.plant_name_c", plants.plant_name_s as "plants.plant_name_s",  plants.plant_image as "plants.plant_image", plants.hardiness_zone_range as "plants.hardiness_zone_range", plants.constructive_play as "plants.constructive_play", plants.sensory_play as "plants.sensory_play" , plants.physical_play as "plants.physical_play", plants.imaginative_play as "plants.imaginative_play", plants.restorative_play as "plants.restorative_play", plants.expressive_play as "plants.expressive_play" , plants.play_with_rules as "plants.play_with_rules", plants.bio_play as "plants.bio_play", images.extension as "images.extension", classification_tags.classification_id as "classification_tags.classification_id", classifications.classificationname as "classifications.classificationname", detail_tags.detail_id as "detail_tags.detail_id", details.detailname as "details.detailname" FROM plants INNER JOIN images ON (plants.id = images.plant_id) INNER JOIN classification_tags ON (plants.id = classification_tags.plant_id) INNER JOIN classifications ON (classification_tags.classification_id = classifications.id) INNER JOIN detail_tags ON (plants.id = detail_tags.plant_id) INNER JOIN details ON (detail_tags.detail_id = details.id)
    WHERE (plants.id = :id);',
    array(':id' => $update_plant)
  )->fetchAll();

  if (count($records) > 0) {
    $record = $records[0];
  }
} else if ($detailed_id){
  $records = exec_sql_query(
    $db,
    'SELECT plants.id as "plants.id", plants.plant_name_c as "plants.plant_name_c", plants.plant_name_s as "plants.plant_name_s",  plants.plant_image as "plants.plant_image", plants.hardiness_zone_range as "plants.hardiness_zone_range", plants.constructive_play as "plants.constructive_play", plants.sensory_play as "plants.sensory_play" , plants.physical_play as "plants.physical_play", plants.imaginative_play as "plants.imaginative_play", plants.restorative_play as "plants.restorative_play", plants.expressive_play as "plants.expressive_play" , plants.play_with_rules as "plants.play_with_rules", plants.bio_play as "plants.bio_play", images.extension as "images.extension", classification_tags.classification_id as "classification_tags.classification_id", classifications.classificationname as "classifications.classificationname", detail_tags.detail_id as "detail_tags.detail_id", details.detailname as "details.detailname" FROM plants INNER JOIN images ON (plants.id = images.plant_id) INNER JOIN classification_tags ON (plants.id = classification_tags.plant_id) INNER JOIN classifications ON (classification_tags.classification_id = classifications.id) INNER JOIN detail_tags ON (plants.id = detail_tags.plant_id) INNER JOIN details ON (detail_tags.detail_id = details.id)
    WHERE (plants.id = :id);',
    array(':id' => $detailed_id)
  )->fetchAll();

  if (count($records) > 0) {
    $record = $records[0];
  }
}

if ($record) {
  $id = $record['plants.id'];
  $colloquial_name = $record['plants.plant_name_c'];
  $scientific_name = $record['plants.plant_name_s'];
  $image_id = $record['plants.plant_image'];
  $hardiness = $record['plants.hardiness_zone_range'];

  $constructive_play = $record['plants.constructive_play'];
  $sensory_play = $record['plants.sensory_play'];
  $physical_play = $record['plants.physical_play'];
  $imaginative_play = $record['plants.imaginative_play'];
  $restorative_play = $record['plants.restorative_play'];
  $expressive_play = $record['plants.expressive_play'];
  $rule_play = $record['plants.play_with_rules'];
  $bio_play = $record['plants.bio_play'];

  foreach ($records as $record) {
    //review this --> if the record is the same should it be checked??
    $class = $record["classification_tags.classification_id"];
    if ($class == 1){
      $shrub = 'checked';
    }
    if ($class == 2){
      $grass = 'checked';
    }
    if ($class == 3){
      $vine = 'checked';
    }
    if ($class == 4){
      $tree = 'checked';
    }
    if ($class == 5){
      $flower = 'checked';
    }
    if ($class == 6){
      $groundcovers = 'checked';
    }
    if ($class == 7){
      $other = 'checked';
    }

    $detail = $record["detail_tags.detail_id"];
    if ($detail == 1){
      $perennial = 'checked';
    }
    if ($detail == 2){
      $annual = 'checked';
    }
    if ($detail == 3){
      $fullsun = 'checked';
    }
    if ($detail == 4){
      $partialshade = 'checked';
    }
    if ($detail == 5){
      $fullshade = 'checked';
    }

  }

  $sticky_colloquial_name = $colloquial_name;
  $sticky_scientific_name = $scientific_name;
  $sticky_image_id = $image_id;
  $sticky_hardiness = $hardiness;

  $sticky_constructive_play = ($constructive_play == 1 ? 'checked':'');
  $sticky_sensory_play = ($sensory_play == 1 ? 'checked':'');
  $sticky_physical_play = ($physical_play == 1 ? 'checked':'');
  $sticky_imaginative_play = ($imaginative_play == 1 ? 'checked':'');
  $sticky_restorative_play = ($restorative_play == 1 ? 'checked':'');
  $sticky_expressive_play = ($expressive_play == 1 ? 'checked':'');
  $sticky_rule_play = ($rule_play == 1 ? 'checked':'');
  $sticky_bio_play = ($bio_play == 1 ? 'checked':'');

  $sticky_shrub = $shrub;
  $sticky_grass = $grass;
  $sticky_vine = $vine;
  $sticky_tree = $tree;
  $sticky_flower = $flower;
  $sticky_groundcovers = $groundcovers;
  $sticky_other = $other;

  $sticky_perennial = $perennial;
  $sticky_annual = $annual;
  $sticky_fullsun = $fullsun;
  $sticky_partialshade = $partialshade;
  $sticky_fullshade = $fullshade;

  // feedback message classes
  $names_feedback_class = 'hidden';
  $playtype_feedback_class = 'hidden';
  $classification_feedback_class = 'hidden';
  $file_feedback_class = 'hidden';

  //
  if ($update_plant) {

    $colloquial_name = trim($_POST['pn_c']);
    $scientific_name = trim($_POST['pn_s']);
    $image_id = trim($_POST['pID']);
    $hardiness = trim($_POST['hardiness']);

    $constructive_play = $_POST["c_play"];
    $sensory_play = $_POST["s_play"];
    $physical_play = $_POST["p_play"];
    $imaginative_play = $_POST["i_play"];
    $restorative_play = $_POST["r_play"];
    $expressive_play = $_POST["e_play"];
    $rule_play = $_POST["ru_play"];
    $bio_play = $_POST["b_play"];

    $shrub = $_POST["shrub"];
    $grass = $_POST["grass"];
    $vine = $_POST["vine"];
    $tree = $_POST["tree"];
    $flower = $_POST["flower"];
    $groundcovers = $_POST["groundcovers"];
    $other = $_POST["other"];

    $perennial = $_POST["perennial"];
    $annual = $_POST["annual"];
    $fullsun = $_POST["fullsun"];
    $partialshade = $_POST["partialshade"];
    $fullshade = $_POST["fullshade"];

    // add all classes into an array to insert into classification_tags table later
    $newclasses = array();
    if ($shrub == "on"){
      array_push($newclasses, 1);
    }
    if ($grass == "on"){
      array_push($newclasses, 2);
    }
    if ($vine == "on"){
      array_push($newclasses, 3);
    }
    if ($tree == "on"){
      array_push($newclasses, 4);
    }
    if ($flower == "on"){
      array_push($newclasses, 5);
    }
    if ($groundcovers == "on"){
      array_push($newclasses, 6);
    }
    if ($other == "on"){
      array_push($newclasses, 7);
    }

    $newdetails = array();
    if ($perennial == "on"){
      array_push($newdetails, 1);
    }
    if ($annual == "on"){
      array_push($newdetails, 2);
    }
    if ($fullsun == "on"){
      array_push($newdetails, 3);
    }
    if ($partialshade == "on"){
      array_push($newdetails, 4);
    }
    if ($fullshade == "on"){
      array_push($newdetails, 5);
    }

    $uploadF = $_FILES['updatefile'];
    // was upload successful??
    if ($uploadF['name'] != '' && $uploadF['error'] == UPLOAD_ERR_OK) {
        // The upload was successful!
        $upload_name = basename($uploadF['name']);
        $upload_exten = strtolower(pathinfo($upload_name, PATHINFO_EXTENSION));

        // This site only accepts image files! --> acceptable types include: jpg, png, gif files
        if (!in_array($upload_exten, array('jpg', 'png', 'gif'))) {
            $add_form_valid = False;
        }
    } else {
        $upload_exten = 'jpg';
    }

    //boolean expression
    $form_valid = True;

    // colloquialid is required
    if (empty($colloquial_name) || empty($scientific_name)|| empty($image_id)) {
      $form_valid = False;
      $names_feedback_class = '';
    }
    // at least one playtype is required
    if (empty($constructive_play) && empty($sensory_play) && empty($physical_play) && empty($imaginative_play) && empty($restorative_play) && empty($expressive_play) && empty($rule_play) && empty($bio_play)){
      $form_valid = false;
      $playtype_feedback_class = '';
    }

    //at least one classification is required
    if (empty($shrub) && empty($grass) && empty($vine) && empty($tree) && empty($flower) && empty($groundcovers) && empty($other)){
      $form_valid = false;
      $classification_feedback_class = '';
    }

    //at least one detail is required
    if (empty($perennial) && empty($annual) && empty($fullsun) && empty($partialshade) && empty($fullshade)){
      $form_valid = false;
      $details_feedback_class = '';
    }

    if ($form_valid) {
      $update_query = 'UPDATE plants SET plant_name_c = :plant_name_c, plant_name_s = :plant_name_s, plant_image = :plant_image, hardiness_zone_range = :hardiness, constructive_play = :constructive_play, sensory_play = :sensory_play, physical_play = :physical_play, imaginative_play = :imaginative_play, restorative_play = :restorative_play, expressive_play = :expressive_play, play_with_rules = :play_with_rules, bio_play = :bio_play WHERE (id= :id);';

      $update_param = array(
        ':plant_name_c' => $colloquial_name,
        ':plant_name_s' => $scientific_name,
        ':plant_image' => $image_id,
        ':hardiness' => $hardiness,
        ':constructive_play' => ($constructive_play == "on" ? 1: 0),
        ':sensory_play' => ($sensory_play == "on" ? 1: 0),
        ':physical_play' => ($physical_play == "on" ? 1: 0),
        ':imaginative_play' => ($imaginative_play == "on" ? 1: 0),
        ':restorative_play' => ($restorative_play == "on" ? 1: 0),
        ':expressive_play' => ($expressive_play == "on" ? 1: 0),
        ':play_with_rules' => ($rule_play == "on" ? 1: 0),
        ':bio_play' => ($bio_play == "on" ? 1: 0),
        ':id' => $id
      );

      $result_updateplants = exec_sql_query( $db, $update_query, $update_param);

      $delete_classifications = exec_sql_query(
        $db,
        'DELETE FROM classification_tags WHERE (plant_id = :id)',
        array(':id' => $id)
      );

      foreach($newclasses as $newclass){
        $result_classifications = exec_sql_query(
          $db,
          'INSERT INTO classification_tags (plant_id, classification_id) VALUES (:plant_id, :classification_id)',
          array(
            ':plant_id' => $id,
            ':classification_id' => $newclass
          ));
      }

      $delete_details = exec_sql_query(
        $db,
        'DELETE FROM detail_tags WHERE (plant_id = :id)',
        array(':id' => $id)
      );

      foreach($newdetails as $newdetail){
        $result_details = exec_sql_query(
          $db,
          'INSERT INTO detail_tags (plant_id, detail_id) VALUES (:plant_id, :detail_id)',
          array(
            ':plant_id' => $id,
            ':detail_id' => $newdetail
          ));
      }

      // insert new plant's image information to the images table
      // remove old one first
      if ($uploadF['name'] != ''){
        $oldfilepath = "public/uploads/images/".$sticky_image_id.".".$record["images.extension"];
        unlink($oldfilepath);
        $delete_image_exist = exec_sql_query($db, "DELETE FROM images WHERE (plant_id = :id)", array(':id' => $id));
        $sql_images = "INSERT INTO images (plant_id, extension) VALUES (:plant_id, :extension);";
        $params_images = array(':plant_id' => $id, ':extension' => $upload_exten);
        $result_images = exec_sql_query($db, $sql_images, $params_images);
      }

      // move the uploaded image to it appropriate directory
      if ($result_updateplants && $result_classifications && $result_details && $result_images) {
          $filepath = "public/uploads/images/".$image_id.".".$upload_exten;
          move_uploaded_file($uploadF['tmp_name'], $filepath);
      }

    } else {
      $file_feedback_class = '';
      // form is invalid, set sticky values
      $sticky_colloquial_name = $colloquial_name;
      $sticky_scientific_name = $scientific_name;
      $sticky_image_id = $image_id;
      $sticky_hardiness = $hardiness;
      //reference project 2
      $sticky_constructive_play = (empty($constructive_play) ? '' : 'checked');
      $sticky_sensory_play = (empty($sensory_play) ? '' : 'checked');
      $sticky_physical_play = (empty($physical_play) ? '' : 'checked');
      $sticky_imaginative_play = (empty($imaginative_play) ? '' : 'checked');
      $sticky_restorative_play = (empty($restorative_play) ? '' : 'checked');
      $sticky_expressive_play = (empty($expressive_play) ? '' : 'checked');
      $sticky_rule_play = (empty($rule_play) ? '' : 'checked');
      $sticky_bio_play = (empty($bio_play) ? '' : 'checked');

      $sticky_shrub = (empty($shrub) ? '' : 'checked');
      $sticky_grass = (empty($grass) ? '' : 'checked');
      $sticky_vine = (empty($vine) ? '' : 'checked');
      $sticky_tree = (empty($tree) ? '' : 'checked');
      $sticky_flower = (empty($flower) ? '' : 'checked');
      $sticky_groundcovers = (empty($groundcovers) ? '' : 'checked');
      $sticky_other = (empty($other) ? '' : 'checked');

      $sticky_perennial = (empty($perennial) ? '' : 'checked');
      $sticky_annual = (empty($annual) ? '' : 'checked');
      $sticky_fullsun = (empty($fullsun) ? '' : 'checked');
      $sticky_partialshade = (empty($partialshade) ? '' : 'checked');
      $sticky_fullshade = (empty($fullshade) ? '' : 'checked');
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Edit <?php echo ($record['plants.plant_name_c']); ?></title>
  <link rel="stylesheet" type="text/css" href="/public/styles/style.css" media="all" />
</head>

<body>
  <?php include('includes/header.php'); ?>
<!-- THIS IS THE EDIT FORM -->
  <?php if (is_user_logged_in() && $is_admin){ ?>
    <div class = "center detailed">
    <h4> Update Plant Information </h4>
    <?php if ($record == NULL) {?>
      <p> Unknown plant, sorry! </p>
      <p> Click <a href = "/">here </a> to return back home </p>
    <?php } else if ($form_valid){ ?>
      <p> <?php echo($colloquial_name)?> was successfully editted. </p>
      <p> Click <a href = "/"> here </a> to return to overall gallery </p>
    <?php } else { ?>
    <div class = "imageAdetails">
    <?php
      $image_path = "public/uploads/images/".$record["plants.plant_image"].".".$record['images.extension'];
      // Source: (Instructor provided) Kyle Harms
      if (!file_exists($image_path)){
         $image_path = "public/uploads/no-image.jpg";
         // Source: (original work) Stephanie Zhang
      }
    ?>
    <img class = "detailedimg" src=<?php echo htmlspecialchars($image_path); ?> alt="<?php echo htmlspecialchars($record["plants.plant_name_c"]); ?>">
    <div class = "details">
    <form id="update-form" method="post" action="/update?<?php echo http_build_query(array('id' => $id)); ?>" enctype="multipart/form-data" novalidate>
        <!-- plant name stuff -->
        <h4> Update Plant Basic Information </h4>
        <div class="feedback <?php echo $names_feedback_class; ?>">Please Enter All Basic Information.</div>
        <div class="label-input">
            <label for="update-pn_c">Plant Name (Colloquial):</label>
            <input type="text" name="pn_c" id="update-pn_c" value="<?php echo htmlspecialchars($sticky_colloquial_name); ?>"/>
        </div>
        <div class="label-input">
            <label for="update-pn_s">Plant Name (Scientific):</label>
            <input type="text" name="pn_s" id="update-pn_s" value="<?php echo htmlspecialchars($sticky_scientific_name); ?>"/>
        </div>
        <div class="label-input">
            <label for="update-pID">Plant ID:</label>
            <input type="text" name="pID" id="update-pID" value="<?php echo htmlspecialchars($sticky_image_id); ?>"/>
        </div>
        <div class="label-input">
            <label for="update-hardiness">Hardiness Zone Range:</label>
            <input type="text" name="hardiness" id="update-hardiness" value="<?php echo htmlspecialchars($sticky_hardiness); ?>"/>
        </div>
        <!-- plant play type check boxes -->
        <h4> Update Play Type Categorization </h4>
        <div class="feedback <?php echo $playtype_feedback_class; ?>">Please select at least one play type.</div>
        <div class="label-input">
            <input type="checkbox" name="c_play" id="update-c_play" <?php echo $sticky_constructive_play;?>/>
            <label for="update-c_play">Constructive Play</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="s_play" id="update-s_play" <?php echo $sticky_sensory_play; ?>/>
            <label for="update-s_play">Sensory Play</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="p_play" id="update-p_play" <?php echo $sticky_physical_play; ?>/>
            <label for="update-p_play">Physical Play</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="i_play" id="update-i_play" <?php echo $sticky_imaginative_play; ?>/>
            <label for="update-i_play">Imaginative Play</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="r_play" id="update-r_play" <?php echo $sticky_restorative_play; ?>/>
            <label for="update-r_play">Restorative Play</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="e_play" id="update-e_play" <?php echo $sticky_expressive_play; ?>/>
            <label for="update-e_play">Expressive Play</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="ru_play" id="update-ru_play" <?php echo $sticky_rule_play; ?>/>
            <label for="update-ru_play">Play with Rules</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="b_play" id="update-b_play" <?php echo $sticky_bio_play; ?>/>
            <label for="update-b_play">Bio Play</label>
        </div>
        <!-- plant's classification check boxes -->
        <h4> Update Plant Classification </h4>
        <div class="feedback <?php echo $classification_feedback_class; ?>">Please select at least one classification.</div>
        <div class="label-input">
            <input type="checkbox" name="shrub" id="update-shrub" <?php echo $sticky_shrub; ?>/>
            <label for="update-shrub">Shrub</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="grass" id="update-grass" <?php echo $sticky_grass; ?>/>
            <label for="update-grass">Grass</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="vine" id="update-vine" <?php echo $sticky_vine; ?>/>
            <label for="update-vine">Vine</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="tree" id="update-tree" <?php echo $sticky_tree; ?>/>
            <label for="update-tree">Tree</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="flower" id="update-flower" <?php echo $sticky_flower; ?>/>
            <label for="update-flower">Flower</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="groundcovers" id="update-groundcovers" <?php echo $sticky_groundcovers; ?>/>
            <label for="update-groundcovers">Groundcovers</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="other" id="update-other" <?php echo $sticky_other; ?>/>
            <label for="update-other">Other[Mosses, Ferns, Vegetables, etc.]</label>
        </div>
        <!-- plant's growth details check boxes -->
        <h4> Update Plant Growth Details </h4>
        <div class="feedback <?php echo $classification_feedback_class; ?>">Please select at least one classification.</div>
        <div class="label-input">
            <input type="checkbox" name="perennial" id="update-perennial" <?php echo $sticky_perennial; ?>/>
            <label for="update-perennial">Perennial</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="annual" id="update-annual" <?php echo $sticky_annual; ?>/>
            <label for="update-annual">Annual</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="fullsun" id="update-fullsun" <?php echo $sticky_fullsun; ?>/>
            <label for="update-fullsun">Full Sun</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="partialshade" id="update-partialshade" <?php echo $sticky_partialshade; ?>/>
            <label for="update-partialshade">Partial Shade</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="fullshade" id="update-fullshade" <?php echo $sticky_fullshade; ?>/>
            <label for="update-fullshade">Full Shade</label>
        </div>

        <h4> Plant Image Upload </h4>
        <input type="hidden" name="max_size" value="<?php echo max_size; ?>" />
        <p class="feedback <?php echo $file_feedback_class; ?>">Please select a valid (png, gif, jpg) file.</p>
          <label for="upload-file">Plant File:</label>
          <input id="upload-file" type="file" name="updatefile" accept= "image/png, image/gif, image/jpg"/>

        <!-- submission buton -->
        <div class="align-right">
          <input type="hidden" name="update-plant" value="<?php echo htmlspecialchars($id); ?>" />
          <button type="submit">Save Updated Information</button>
        </div>
    </form>
    </div>
    </div>
    </div>
    <?php }?>
  <?php } else { ?>
    <p> This is an Admin-Only functionality. Please contact administrators of Playful Plants for assistance </p>
  <?php } ?>
  </body>

</html>
