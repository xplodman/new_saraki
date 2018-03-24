<script src="assets/plugins/d3/d3.min.js"></script>
<script src="assets/plugins/c3-master/c3.min.js"></script>
<?php
$count_possession_query = mysqli_query($con,"SELECT
                                              overallpros.name,
                                              overallpros.id,
                                              Count(possession.possession_number) As possession_count
                                            FROM
                                              possession
                                              INNER JOIN case_has_possession ON case_has_possession.possession_possession_number = possession.possession_number AND
                                                case_has_possession.possession_possession_year = possession.possession_year
                                              INNER JOIN `case` ON case_has_possession.case_id = `case`.id
                                              INNER JOIN depart ON `case`.depart_id = depart.id
                                              INNER JOIN pros ON depart.pros_id = pros.id
                                              INNER JOIN overallpros ON pros.overallpros_id = overallpros.id
                                              Where possession.possession_year = YEAR(curdate())
                                            GROUP BY
                                              overallpros.name,
                                              overallpros.id") or die(mysqli_error($con));
$x=1;
while($count_possession_info = mysqli_fetch_assoc($count_possession_query))
{
?>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><span class="lstick"></span><?php echo $count_possession_info['name'] ?></h4>
                <div id="possession_<?php echo $count_possession_info['id']; ?>" style="height:290px; width:100%;"></div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!--c3 JavaScript -->
    <script>
        var chart = c3.generate({
            bindto: "#possession_<?php echo $count_possession_info['id']; ?>",
            data: {
                columns: [
                    <?php
                    $count_still_possession_query = mysqli_query($con,"SELECT
  Count(DISTINCT possession.possession_number, possession.possession_year) AS Count_possession_number
FROM
  possession
  INNER JOIN case_has_possession ON case_has_possession.possession_possession_number = possession.possession_number AND
    case_has_possession.possession_possession_year = possession.possession_year
  INNER JOIN `case` ON `case`.id = case_has_possession.case_id
  INNER JOIN depart ON `case`.depart_id = depart.id
  INNER JOIN pros ON depart.pros_id = pros.id
  INNER JOIN overallpros ON pros.overallpros_id = overallpros.id
WHERE
  possession.case_send_number = 0 AND
  overallpros.id = $count_possession_info[id] AND
  possession.status = 1 AND
  possession.deleted = 0 AND
  `case`.status = 1 AND
  `case`.deleted = 0 AND
  possession.possession_year = YEAR(curdate())
GROUP BY
  overallpros.id,
  possession.status,
  possession.deleted,
  `case`.status,
  `case`.deleted") or die(mysqli_error($con));
                    $count_still_possession_info = mysqli_fetch_assoc($count_still_possession_query);
                    echo "['Still', ".$count_still_possession_info['Count_possession_number']."],";
                    ?>
                    <?php
                    $count_done_possession_query = mysqli_query($con,"SELECT
  Count(DISTINCT possession.possession_number, possession.possession_year) AS Count_possession_number
FROM
  possession
  INNER JOIN case_has_possession ON case_has_possession.possession_possession_number = possession.possession_number AND
    case_has_possession.possession_possession_year = possession.possession_year
  INNER JOIN `case` ON `case`.id = case_has_possession.case_id
  INNER JOIN depart ON `case`.depart_id = depart.id
  INNER JOIN pros ON depart.pros_id = pros.id
  INNER JOIN overallpros ON pros.overallpros_id = overallpros.id
WHERE
  possession.case_send_number > 0 AND
  overallpros.id = $count_possession_info[id] AND
  possession.status = 1 AND
  possession.deleted = 0 AND
  `case`.status = 1 AND
  `case`.deleted = 0 AND
  possession.possession_year = YEAR(curdate())
GROUP BY
  overallpros.id,
  possession.status,
  possession.deleted,
  `case`.status,
  `case`.deleted") or die(mysqli_error($con));
                    $count_done_possession_info = mysqli_fetch_assoc($count_done_possession_query);
                    echo "['Done', ".$count_done_possession_info['Count_possession_number']."],";
                    ?>
                ],
                type : 'donut',
            },
            donut: {
                label: {
                    format: function (value) { return value; }
                },
                title:"<?php echo $count_possession_info['possession_count'] ?>",
                width:50,
            },
            legend: {
                hide: true
                //or hide: 'data1'
                //or hide: ['data1', 'data2']
            },
            color: {
                pattern: ['#26c6da', '#1e88e5']
            }
        });
    </script>
<?php
    $x++;
}
?>
