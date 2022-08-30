<?php

if (is_user_logged_in() && $is_admin){
// set boolean expression for starting show confirmation
$show_confirmation = False;

//set max file size for upload
define("max_size", 10000000);

// feedback messages
$names_feedback_class = 'hidden';
$playtype_feedback_class = 'hidden';
$classifications_feedback_class = 'hidden';
$details_feedback_class = 'hidden';
$file_feedback_class = 'hidden';

// values
$colloquial_name = null;
$scientific_name = null;

$image_id = null;
$image_exten = null;
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


// sticky values
$sticky_colloquial_name = '';
$sticky_scientific_name = '';

$sticky_image_id = '';
$sticky_classification = '';
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


// Did the user submit the form?
if (isset($_POST['add-plant'])) {
    $add_form_valid = True;

    $colloquial_name = trim($_POST['pn_c']);
    $scientific_name = trim($_POST['pn_s']);
    $image_id = trim($_POST['pID']);
    $hardiness = trim($_POST['hardiness']);

    $constructive_play = $_POST['c_play'];
    $sensory_play = $_POST['s_play'];
    $physical_play = $_POST['p_play'];
    $imaginative_play = $_POST['i_play'];
    $restorative_play = $_POST['r_play'];
    $expressive_play = $_POST['e_play'];
    $rule_play = $_POST['ru_play'];
    $bio_play = $_POST['b_play'];

    $shrub = $_POST['shrub'];
    $grass = $_POST['grass'];
    $vine = $_POST['vine'];
    $tree = $_POST['tree'];
    $flower = $_POST['flower'];
    $groundcovers = $_POST['groundcovers'];
    $other = $_POST['other'];

    $perennial = $_POST["perennial"];
    $annual = $_POST["annual"];
    $fullsun = $_POST["fullsun"];
    $partialshade = $_POST["partialshade"];
    $fullshade = $_POST["fullshade"];


    $uploadF = $_FILES['plantfile'];
    // was upload successful??
    if ($uploadF['error'] == UPLOAD_ERR_OK) {
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

    // all names must be entered -- maybe the image_id isn't necessary for a valid form...
    if (empty($colloquial_name) || empty($scientific_name) || empty($image_id)) {
        $add_form_valid = False;
        $names_feedback_class = '';
    }

    // was at least one play type checked?
    if (empty($constructive_play) && empty($sensory_play) && empty($physical_play) && empty($imaginative_play) && empty($restorative_play) && empty($expressive_play) && empty($rule_play) && empty($bio_play)) {
        $add_form_valid = False;
        $playtype_feedback_class = '';
    }
    // was at least one classification checked?
    if (empty($shrub) && empty($grass) && empty($vine) && empty($tree) && empty($flower) && empty($groundcovers) && empty($other)) {
        $add_form_valid = False;
        $classification_feedback_class = '';
    }

    //at least one detail is required
    if (empty($perennial) && empty($annual) && empty($fullsun) && empty($partialshade) && empty($fullshade)){
        $add_form_valid = false;
        $details_feedback_class = '';
    }


    if ($add_form_valid) {
        //check which classifications were checked
        $classifications_total = array();
        $shrub == 'on' ? array_push($classifications_total, 1):0;
        $grass == 'on' ? array_push($classifications_total, 2):0;
        $vine == 'on' ? array_push($classifications_total, 3):0;
        $tree == 'on' ? array_push($classifications_total, 4):0;
        $flower == 'on' ? array_push($classifications_total, 5):0;
        $groundcovers == 'on' ? array_push($classifications_total, 6):0;
        $other == 'on' ? array_push($classifications_total, 7):0;

        $details_total = array();
        $perennial == 'on' ? array_push($details_total, 1):0;
        $annual == 'on' ? array_push($details_total, 2):0;
        $fullsun == 'on' ? array_push($details_total, 3):0;
        $partialshade == 'on' ? array_push($details_total, 4):0;
        $fullshade == 'on' ? array_push($details_total, 5):0;

        // form is valid, hide form, show confirmation page
        $show_confirmation = True;
        $sql_plants = "INSERT INTO plants(plant_name_c, plant_name_s, plant_image, hardiness_zone_range, constructive_play, sensory_play, physical_play, imaginative_play, restorative_play, expressive_play, play_with_rules, bio_play) VALUES (:plant_name_c, :plant_name_s, :plant_image, :hardiness_zone_range, :constructive_play, :sensory_play, :physical_play, :imaginative_play, :restorative_play, :expressive_play, :play_with_rules, :bio_play);";
        $params_plants = array(
            ':plant_name_c'=> $colloquial_name,
            ':plant_name_s'=> $scientific_name,
            ':plant_image'=> $image_id,
            ':hardiness_zone_range' => $hardiness,

            ':constructive_play'=> ($constructive_play == 'on' ? 1:0),
            ':sensory_play'=> ($sensory_play == 'on' ? 1:0),
            ':physical_play'=> ($physical_play == 'on' ? 1:0),
            ':imaginative_play'=> ($imaginative_play == 'on' ? 1:0),
            ':restorative_play'=> ($restorative_play == 'on' ? 1:0),
            ':expressive_play'=> ($expressive_play == 'on' ? 1:0),
            ':play_with_rules'=> ($rule_play == 'on' ? 1:0),
            ':bio_play'=> ($bio_play == 'on' ? 1:0)
        );
        // insert new plant into database
        $result_plants = exec_sql_query($db, $sql_plants, $params_plants);

        // insert new plant's classification(s)
        $justaddedID = $db -> lastInsertId('plants.id');
        foreach ($classifications_total as $classification){
            $sql_classification = "INSERT INTO classification_tags (plant_id, classification_id) VALUES (:plant_id, :classification_id);";
            $params_classification = array(':plant_id' => $justaddedID, ':classification_id' => $classification);
            $result_classification = exec_sql_query($db, $sql_classification, $params_classification);
        }

        // insert new plant's detail(s)
        foreach ($details_total as $detail){
            $sql_detail = "INSERT INTO detail_tags (plant_id, detail_id) VALUES (:plant_id, :detail_id);";
            $params_detail = array(':plant_id' => $justaddedID, ':detail_id' => $detail);
            $result_detail = exec_sql_query($db, $sql_detail, $params_detail);
        }

        // insert new plant's image information to the images table
        $sql_images = "INSERT INTO images (plant_id, extension) VALUES (:plant_id, :extension);";
        $params_images = array(':plant_id' => $justaddedID, ':extension' => $upload_exten);
        $result_images = exec_sql_query($db, $sql_images, $params_images);

        // move the uploaded image to it appropriate directory
        if ($result_plants && $result_classification && $result_detail && $result_images) {
            $filepath = "public/uploads/images/".$image_id.".".$upload_exten;
            move_uploaded_file($uploadF['tmp_name'], $filepath);
        }

    } else {
        $file_feedback_class = '';
        // form is invalid, set sticky values
        $sticky_colloquial_name = $colloquial_name;
        $sticky_scientific_name = $scientific_name;
        $sticky_image_id = $image_id;

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

    <title>Plant Import Form</title>
    <link rel="stylesheet" type="text/css" href="/public/styles/style.css" media="all" />
</head>

<body>
<?php include('includes/header.php'); ?>
    <?php if (is_user_logged_in() && $is_admin){ ?>
    <section>
        <h2> Add New Plant</h2>
        <?php if ($show_confirmation) { ?>
            <section class = "confirmation">
                <p>Successfully Added Plant to Playful Plants!</p>
                <p>Thank you for your contribution to our mission.</p>
                <p>To add more plants, fill the form</p>
            </section>
        <?php } ?>

        <p>Have information about a new plant that isn't in the database? Let us know some of its playful and growth details!</p>

        <form id="add-form" method="post" action="/add-plant" enctype="multipart/form-data" novalidate>
        <h4> Plant Basic Information </h4>
        <div id="feedback-names" class="feedback <?php echo $names_feedback_class; ?>">Please Enter All Basic Information.</div>
        <div class="label-input">
            <label for="add-pn_c">Plant Name (Colloquial):</label>
            <input type="text" name="pn_c" id="add-pn_c" value="<?php echo htmlspecialchars($sticky_colloquial_name); ?>"/>
        </div>
        <div class="label-input">
            <label for="add-pn_s">Plant Name (Scientific):</label>
            <input type="text" name="pn_s" id="add-pn_s" value="<?php echo htmlspecialchars($sticky_scientific_name); ?>"/>
        </div>
        <div class="label-input">
            <label for="add-pID">Plant ID:</label>
            <input type="text" name="pID" id="add-pID" value="<?php echo htmlspecialchars($sticky_image_id); ?>"/>
        </div>

        <h4> Play Type Categorization </h4>
        <div id="feedback-playtype" class="feedback <?php echo $playtype_feedback_class; ?>">Please select at least play type.</div>
        <div class="label-input">
            <input type="checkbox" name="c_play" id="add-c_play" <?php echo $sticky_constructive_play; ?>/>
            <label for="add-c_play">Constructive Play</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="s_play" id="add-s_play" <?php echo $sticky_sensory_play; ?>/>
            <label for="add-s_play">Sensory Play</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="p_play" id="add-p_play" <?php echo $sticky_physical_play; ?>/>
            <label for="add-p_play">Physical Play</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="i_play" id="add-i_play" <?php echo $sticky_imaginative_play; ?>/>
            <label for="add-i_play">Imaginative Play</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="r_play" id="add-r_play" <?php echo $sticky_restorative_play; ?>/>
            <label for="add-r_play">Restorative Play</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="e_play" id="add-e_play" <?php echo $sticky_expressive_play; ?>/>
            <label for="add-e_play">Expressive Play</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="ru_play" id="add-ru_play" <?php echo $sticky_rule_play; ?>/>
            <label for="add-ru_play">Play with Rules</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="b_play" id="add-b_play" <?php echo $sticky_bio_play; ?>/>
            <label for="add-b_play">Bio Play</label>
        </div>

        <h4> Plant Classification </h4>
        <div class="feedback <?php echo $classifications_feedback_class; ?>">Please select at least one classification.</div>
        <div class="label-input">
            <input type="checkbox" name="shrub" id="add-shrub" <?php echo $sticky_shrub; ?>/>
            <label for="add-shrub">Shrub</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="grass" id="add-grass" <?php echo $sticky_grass; ?>/>
            <label for="add-grass">Grass</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="vine" id="add-vine" <?php echo $sticky_vine; ?>/>
            <label for="add-vine">Vine</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="tree" id="add-tree" <?php echo $sticky_tree; ?>/>
            <label for="add-tree">Tree</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="flower" id="add-flower" <?php echo $sticky_flower; ?>/>
            <label for="add-flower">Flower</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="groundcovers" id="add-groundcovers" <?php echo $sticky_groundcovers; ?>/>
            <label for="add-groundcovers">Groundcovers</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="other" id="add-other" <?php echo $sticky_other; ?>/>
            <label for="add-other">Other[Mosses, Ferns, Vegetables, etc.]</label>
        </div>
        <h4> Plant Growth Details </h4>
        <div class="feedback <?php echo $details_feedback_class; ?>">Please select at least one growth detail.</div>
        <div class="label-input">
            <input type="checkbox" name="perennial" id="add-perennial" <?php echo $sticky_perennial; ?>/>
            <label for="add-perennial">Perennial</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="annual" id="add-annual" <?php echo $sticky_annual; ?>/>
            <label for="add-annual">Annual</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="fullsun" id="add-fullsun" <?php echo $sticky_fullsun; ?>/>
            <label for="add-fullsun">Full Sun</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="partialshade" id="add-partialshade" <?php echo $sticky_partialshade; ?>/>
            <label for="add-partialshade">Partial Shade</label>
        </div>
        <div class="label-input">
            <input type="checkbox" name="fullshade" id="add-fullshade" <?php echo $sticky_fullshade; ?>/>
            <label for="add-fullshade">Full Shade</label>
        </div>
        <div class="label-input">
            <label for="add-hardiness">Plant Hardiness Zone:</label>
            <input type="text" name="hardiness" id="add-hardiness" value="<?php echo htmlspecialchars($sticky_hardiness); ?>"/>
        </div>

        <h4> Plant Image Upload </h4>
        <input type="hidden" name="max_size" value="<?php echo max_size; ?>" />
        <!-- maybe not necessary for a user to upload no images of a plant so maybe no need for this feedback -->
        <p class="feedback <?php echo $file_feedback_class; ?>">Please select a valid (png, gif, jpg) file.</p>
          <label for="upload-file">Plant File:</label>
          <!-- file type can be any according to guidelines -->
          <input id="upload-file" type="file" name="plantfile" accept= "image/png, image/gif, image/jpg"/>


        <div class="align-right">
            <input name = "add-plant" type="submit" value="Add Plant" />
        </div>
        </form>
    </section>
    <?php } else { ?>
        <p> This is an Admin-Only functionality. Please contact administrators of Playful Plants for assistance </p>
    <?php } ?>

</body>

</html>
