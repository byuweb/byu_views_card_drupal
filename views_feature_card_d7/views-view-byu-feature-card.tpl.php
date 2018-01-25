<?php
/**
 * @file
 * Default simple view template to display a rows in a BYU card.
 *
 * - $rows contains a nested array of rows. Each row contains an array of
 *   columns.
 * - $columns contains a nested array of columns. Each column contains an
 *   array of columns.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)) : ?>
    <h3><?php print $title; ?></h3>
<?php endif; ?>

<?php
//for each region, instead of printing it once
?>
<div class="card-container columns-<?php print $cols; ?> align-<?php print $alignment;
foreach ($feature_top as $top_field) {
    print ' top-' . $top_field . " ";
}
foreach ($feature_left as $left_field) {
    print ' left-' . $left_field . " ";
}
foreach ($feature_right as $right_field) {
    print 'right-' . $right_field . " ";
}
foreach ($feature_center as $center_field) {
    print 'center-' . $center_field . " ";
}
    ?>
" >
    <?php

// this will become a long html string of all fields, after formatting for component

    foreach ($rows as $id => $row): ?>




            <?php

//            dpm($feature_title);
            $newRow = ''; // this will become a long html string of all fields, after formatting for component


            // take big long $row string and split it into the main field div's by their wrapper. find a div with a .view-field
            // class on it and get all of itself, including internal things
            $re = '/<(\w+ class="views-field[ "])[^>]*>/';

            // create an array of those items
//            $fieldNames = preg_split($re, $row);
            $positions = array();
            preg_match_all($re, $row, $fieldData,PREG_OFFSET_CAPTURE );
            $size = sizeof($fieldData[0]);
//            dpm($fieldData);
            for($y = 0; $y < $size; $y++ ) {
                $positions[] = $fieldData[0][$y][1];
//            dpm($positions);
            }
            $fields = array();
            $numberOfFields = sizeof($positions);
//            print "# of fields: " . $numberOfFields;
            for($y = 0;  $y <= $numberOfFields; $y++ ) {

                if($y > 0) {
                    if($y < $numberOfFields) {
                        $singleField = substr($row, $beginning, ($positions[$y] - $beginning));
//                        print "single field is "  . $singleField;
                        $fields[] = $singleField;
                    } else {
                        // on the last one
                        $singleField = substr($row, $beginning);
                        $fields[] = $singleField;
                        break;
                    }
                }
                $beginning = $positions[$y];
            }
//            dpm($fields);
//            // small fields loop to get color value
            $colorVal = '';
            foreach ($fields as $fieldItem) {
//                print $title_color;
                // if Title Color is empty, set to Navy
                if(strpos($fieldItem, $title_color) !== false){
                    // exists, correct field
//                    print $fieldItem;
                    $stripPattern = '/<[\w\d "\/=-]*>/';
                    $colorVal = preg_replace($stripPattern, '', $fieldItem);
                    $colorVal = trim($colorVal);
                    $stripWhite = '/\s*/';
                    $colorVal = preg_replace($stripWhite, '', $colorVal);
//                    print $colorVal;
//                    break;
                }
            }
            ?>


        <byu-feature-card columns="<?php print $cols; ?>" class="<?php print $card_width;
            print " " . $colorVal;
        ?>
">
            <?php
//            dpm($fields);

//             loop through, and for each, CHECK

                foreach ($fields as $fieldItem) {

                    preg_match('/(?<=<div class="views-field views-field-)(.*)(?="> )/', $fieldItem, $fieldNameData);

//                    dpm($fieldNameData);
                    $fieldName = $fieldNameData[0];
//                    print '<p>name is ' . $fieldName . '</p>';


//            //check if left, right or center contains it
//                    dpm($feature_right);
                    if ($fieldName == $feature_title) {

                        $slot = " slot='title' ";
                        // first wrapper div starting
                        $newFieldItem = preg_replace('/<(\w+ class="views-field[ "])[^>]*>\w*\s*/', '', $fieldItem);
                        // second wrapper div starting


                        $newFieldItem = preg_replace('/<\w+ class="field-content">/', '', $fieldItem);
// removes 2 start wrappers
//                        <(\w+ class="views-field[ "])[^>]*>\w*\s*<\w+ class="field-content">

                        // remove end wrapper tags
                        $re2 = '/<\//';
                        $endPos = array();
                        preg_match_all($re2, $newFieldItem, $endingData, PREG_OFFSET_CAPTURE);
                        $endSize = sizeof($endingData[0]);
                        $last = $endSize - 1;
                        $secondToLast = $endSize - 2;

                        // check if field-content wrapper exists
                        preg_match('/<\w+ class="field-content">/', $fieldItem, $hasFieldContent);
                        if(!empty($hasFieldContent)) {
                            // it does have a field-content wrapper
                            $cutoff = $endingData[0][$secondToLast][1];
                        } else {
                            // no field-content wrapper
                            $cutoff = $endingData[0][$last][1];
                        }

                        $newFieldItem = substr($newFieldItem, 0, $cutoff);


                        // Insert the Slot info

                        $re3 = '/<\w+[ >]/';
                        preg_match_all($re3, $newFieldItem, $insertPosArr, PREG_OFFSET_CAPTURE);
//                        dpm($insertPosArr);
                        $insertSize = sizeof($insertPosArr);

                        for($y = 0;  $y < $insertSize; $y++ ) {
                            $thisInsertPos = $insertPosArr[0][$y][1];
                            $thisInsertString = $insertPosArr[0][$y][0];
                            $thisInsertLength = strlen($thisInsertString);


                            $insertPos = $thisInsertPos + $thisInsertLength -1;
                            $start = substr($newFieldItem, 0, $insertPos);
                            $end = substr($newFieldItem, $insertPos);
                            $newFieldItem = $start . $slot . $end . '</div>';

                        }

                        $newRow .= $newFieldItem;
                    }
                    elseif (in_array($fieldName, $feature_top)) {
                        $slot = " slot='feature-top' ";
                        // first wrapper div starting
                        $newFieldItem = preg_replace('/<(\w+ class="views-field[ "])[^>]*>\w*\s*/', '', $fieldItem);
                        // second wrapper div starting

                        $newFieldItem = preg_replace('/<\w+ class="field-content">/', '', $fieldItem);
// removes 2 start wrappers
//                        <(\w+ class="views-field[ "])[^>]*>\w*\s*<\w+ class="field-content">

                        // remove end wrapper tags
                        $re2 = '/<\//';
                        $endPos = array();
                        preg_match_all($re2, $newFieldItem, $endingData, PREG_OFFSET_CAPTURE);
                        $endSize = sizeof($endingData[0]);
                        $last = $endSize - 1;
                        $secondToLast = $endSize - 2;

                        // check if field-content wrapper exists
                        preg_match('/<\w+ class="field-content">/', $fieldItem, $hasFieldContent);
                        if (!empty($hasFieldContent)) {
                            // it does have a field-content wrapper
                            $cutoff = $endingData[0][$secondToLast][1];
                        } else {
                            // no field-content wrapper
                            $cutoff = $endingData[0][$last][1];
                        }

                        $newFieldItem = substr($newFieldItem, 0, $cutoff);

                        // Insert the Slot info
                        $re3 = '/<\w+[ >]/';
                        preg_match_all($re3, $newFieldItem, $insertPosArr, PREG_OFFSET_CAPTURE);
//                        dpm($insertPosArr);
                        $insertSize = sizeof($insertPosArr);

                        for ($y = 0; $y < $insertSize; $y++) {
                            $thisInsertPos = $insertPosArr[0][$y][1];
                            $thisInsertString = $insertPosArr[0][$y][0];
                            $thisInsertLength = strlen($thisInsertString);

                            $insertPos = $thisInsertPos + $thisInsertLength - 1;
                            $start = substr($newFieldItem, 0, $insertPos);
                            $end = substr($newFieldItem, $insertPos);
                            $newFieldItem = $start . $slot . $end . '</div>';
                        }
                        $newRow .= $newFieldItem;
                    }
                    elseif (in_array($fieldName, $feature_left)) {

                        $slot = " slot='feature-left' ";
                        // first wrapper div starting
                        $newFieldItem = preg_replace('/<(\w+ class="views-field[ "])[^>]*>\w*\s*/', '', $fieldItem);
                        // second wrapper div starting


                        $newFieldItem = preg_replace('/<\w+ class="field-content">/', '', $fieldItem);
// removes 2 start wrappers
//                        <(\w+ class="views-field[ "])[^>]*>\w*\s*<\w+ class="field-content">

                        // remove end wrapper tags
                        $re2 = '/<\//';
                        $endPos = array();
                        preg_match_all($re2, $newFieldItem, $endingData, PREG_OFFSET_CAPTURE);
                        $endSize = sizeof($endingData[0]);
                        $last = $endSize - 1;
                        $secondToLast = $endSize - 2;

                        // check if field-content wrapper exists
                        preg_match('/<\w+ class="field-content">/', $fieldItem, $hasFieldContent);
                        if(!empty($hasFieldContent)) {
                            // it does have a field-content wrapper
                            $cutoff = $endingData[0][$secondToLast][1];
                        } else {
                            // no field-content wrapper
                            $cutoff = $endingData[0][$last][1];
                        }

                        $newFieldItem = substr($newFieldItem, 0, $cutoff);


                        // Insert the Slot info

                        $re3 = '/<\w+[ >]/';
                        preg_match_all($re3, $newFieldItem, $insertPosArr, PREG_OFFSET_CAPTURE);
//                        dpm($insertPosArr);
                        $insertSize = sizeof($insertPosArr);

                        for($y = 0;  $y < $insertSize; $y++ ) {
                            $thisInsertPos = $insertPosArr[0][$y][1];
                            $thisInsertString = $insertPosArr[0][$y][0];
                            $thisInsertLength = strlen($thisInsertString);


                            $insertPos = $thisInsertPos + $thisInsertLength -1;
                            $start = substr($newFieldItem, 0, $insertPos);
                            $end = substr($newFieldItem, $insertPos);
                            $newFieldItem = $start . $slot . $end . '</div>';

                        }

                        $newRow .= $newFieldItem;
                    } elseif (in_array($fieldName, $feature_right)) {

                        $slot = " slot='feature-right' ";
                        // first wrapper div starting
                        $newFieldItem = preg_replace('/<(\w+ class="views-field[ "])[^>]*>\w*\s*/', '', $fieldItem);
                        // second wrapper div starting


                        $newFieldItem = preg_replace('/<\w+ class="field-content">/', '', $fieldItem);
// removes 2 start wrappers
//                        <(\w+ class="views-field[ "])[^>]*>\w*\s*<\w+ class="field-content">

                        // remove end wrapper tags
                        $re2 = '/<\//';
                        $endPos = array();
                        preg_match_all($re2, $newFieldItem, $endingData, PREG_OFFSET_CAPTURE);
                        $endSize = sizeof($endingData[0]);
                        $last = $endSize - 1;
                        $secondToLast = $endSize - 2;

                        // check if field-content wrapper exists
                        preg_match('/<\w+ class="field-content">/', $fieldItem, $hasFieldContent);
                        if(!empty($hasFieldContent)) {
                            // it does have a field-content wrapper
                            $cutoff = $endingData[0][$secondToLast][1];
                        } else {
                            // no field-content wrapper
                            $cutoff = $endingData[0][$last][1];
                        }

                        $newFieldItem = substr($newFieldItem, 0, $cutoff);


                        // Insert the Slot info

                        $re3 = '/<\w+[ >]/';
                        preg_match_all($re3, $newFieldItem, $insertPosArr, PREG_OFFSET_CAPTURE);
//                        dpm($insertPosArr);
                        $insertSize = sizeof($insertPosArr);

                        for($y = 0;  $y < $insertSize; $y++ ) {
                            $thisInsertPos = $insertPosArr[0][$y][1];
                            $thisInsertString = $insertPosArr[0][$y][0];
                            $thisInsertLength = strlen($thisInsertString);


                            $insertPos = $thisInsertPos + $thisInsertLength -1;
                            $start = substr($newFieldItem, 0, $insertPos);
                            $end = substr($newFieldItem, $insertPos);
                            $newFieldItem = $start . $slot . $end . '</div>';

                        }

                        $newRow .= $newFieldItem;

                    } elseif (in_array($fieldName, $feature_center)) {
                        $slot = " slot='feature-center' ";
                        // first wrapper div starting
                        $newFieldItem = preg_replace('/<(\w+ class="views-field[ "])[^>]*>\w*\s*/', '', $fieldItem);
                        // second wrapper div starting


                        $newFieldItem = preg_replace('/<\w+ class="field-content">/', '', $fieldItem);
// removes 2 start wrappers
//                        <(\w+ class="views-field[ "])[^>]*>\w*\s*<\w+ class="field-content">

                        // remove end wrapper tags
                        $re2 = '/<\//';
                        $endPos = array();
                        preg_match_all($re2, $newFieldItem, $endingData, PREG_OFFSET_CAPTURE);
                        $endSize = sizeof($endingData[0]);
                        $last = $endSize - 1;
                        $secondToLast = $endSize - 2;

                        // check if field-content wrapper exists
                        preg_match('/<\w+ class="field-content">/', $fieldItem, $hasFieldContent);
                        if(!empty($hasFieldContent)) {
                            // it does have a field-content wrapper
                            $cutoff = $endingData[0][$secondToLast][1];
                        } else {
                            // no field-content wrapper
                            $cutoff = $endingData[0][$last][1];
                        }

                        $newFieldItem = substr($newFieldItem, 0, $cutoff);


                        // Insert the Slot info

                        $re3 = '/<\w+[ >]/';
                        preg_match_all($re3, $newFieldItem, $insertPosArr, PREG_OFFSET_CAPTURE);
//                        dpm($insertPosArr);
                        $insertSize = sizeof($insertPosArr);

                        for($y = 0;  $y < $insertSize; $y++ ) {
                            $thisInsertPos = $insertPosArr[0][$y][1];
                            $thisInsertString = $insertPosArr[0][$y][0];
                            $thisInsertLength = strlen($thisInsertString);


                            $insertPos = $thisInsertPos + $thisInsertLength -1;
                            $start = substr($newFieldItem, 0, $insertPos);
                            $end = substr($newFieldItem, $insertPos);
                            $newFieldItem = $start . $slot . $end . '</div>';

                        }

                        $newRow .= $newFieldItem;
                    }


                } // end loop going through each field

            ?>


            <?php print $newRow;
//            print '</div>';
            ?>
<!--            --><?php //print $row; ?>

        </byu-feature-card>
    <?php endforeach; ?>
</div>

