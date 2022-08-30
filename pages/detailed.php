<?php
// load current plant information by getting the plant ID for the one that was clicked
$detailed_id = $_GET['id'] ?? NULL;

if ($detailed_id){
  $records = exec_sql_query(
    $db,
    'SELECT plants.id as "plants.id", plants.plant_name_c as "plants.plant_name_c", plants.plant_name_s as "plants.plant_name_s",  plants.plant_image as "plants.plant_image", plants.hardiness_zone_range as "plants.hardiness_zone_range", plants.constructive_play as "plants.constructive_play", plants.sensory_play as "plants.sensory_play" , plants.physical_play as "plants.physical_play", plants.imaginative_play as "plants.imaginative_play", plants.restorative_play as "plants.restorative_play", plants.expressive_play as "plants.expressive_play" , plants.play_with_rules as "plants.play_with_rules", plants.bio_play as "plants.bio_play", images.extension as "images.extension", classification_tags.classification_id as "classification_tags.classification_id", classifications.classificationname as "classifications.classificationname", detail_tags.detail_id as "detail_tags.detail_id", details.detailname as "details.detailname" FROM plants INNER JOIN images ON (plants.id = images.plant_id) INNER JOIN classification_tags ON (plants.id = classification_tags.plant_id) INNER JOIN classifications ON (classification_tags.classification_id = classifications.id) INNER JOIN detail_tags ON (plants.id = detail_tags.plant_id) INNER JOIN details ON (detail_tags.detail_id = details.id) WHERE ("plants.id" = :id);',
    array(':id' => $detailed_id)
  )->fetchAll();

  if (count($records) > 0) {
    $record = $records[0];
  }

  $play_type_total = array();
  $record["plants.constructive_play"] == 1 ? array_push($play_type_total,'Constructive') : '';
  $record["plants.sensory_play"] == 1 ? array_push($play_type_total,'Sensory') : '';
  $record["plants.physical_play"] == 1 ? array_push($play_type_total,'Physical') : '';
  $record["plants.imaginative_play"] == 1 ? array_push($play_type_total,'Imaginative') : '';
  $record["plants.restorative_play"] == 1 ? array_push($play_type_total,'Restorative') : '';
  $record["plants.expressive_play"] == 1 ? array_push($play_type_total,'Expressive') : '';
  $record["plants.play_with_rules"] == 1 ? array_push($play_type_total,'Rules') : '';
  $record["plants.bio_play"] == 1 ? array_push($play_type_total,'Bio') : '';

  $class_total = array();
  foreach ($records as $record){
    if (!in_array($record["classifications.classificationname"], $class_total)){
      array_push($class_total, $record["classifications.classificationname"]);
    }
  }
  $detail_total = array();
  foreach ($records as $record){
    if (!in_array($record["details.detailname"], $detail_total)){
      array_push($detail_total, $record["details.detailname"]);
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="/public/styles/style.css" media="all" />
</head>

<body>
  <?php include('includes/header.php'); ?>
  <main>
      <div class = "center detailed">
      <h2><?php echo ($record['plants.plant_name_c']); ?></h2>
      <h3><?php echo ($record['plants.plant_name_s']); ?></h3>
      <div class = "imageAdetails">
        <?php
          $image_path = "public/uploads/images/".$record["plants.plant_image"].'.'.$record["images.extension"];
          // Source: (Instructor provided) Kyle Harms
          if (!file_exists($image_path)){ // should the default image be in the upload folder??
            $image_path = "public/uploads/no-image.jpg";
            // Source: (original work) Stephanie Zhang
          }
        ?>
        <img class = "detailedimg" src= <?php echo htmlspecialchars($image_path) ?> alt="<?php echo htmlspecialchars($record["plants.plant_name_c"]); ?>">
        <div class = "details">
        <h4>Play Type(s)</h4>
          <ul>
            <?php foreach ($play_type_total as $play_type) {?>
              <li><?php echo htmlspecialchars($play_type)?></li>
            <?php } ?>
          </ul>
        <h4>Classification(s)</h4>
          <ul>
            <?php foreach ($class_total as $class) {?>
              <li><?php echo htmlspecialchars($class)?></li>
            <?php } ?>
          </ul>
        <h4>Growth Promotion Detail(s)</h4>
          <ul>
            <?php foreach ($detail_total as $detail) {?>
              <li><?php echo htmlspecialchars($detail)?></li>
            <?php } ?>
          </ul>
        </div>
    </div>
    </div>
  </main>

</body>

</html>
