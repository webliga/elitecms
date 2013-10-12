<table class="table table-striped table-bordered table-hover">
    <caption><?php echo $dataArr['thead'];
unset($dataArr['thead']);
?></caption>
    <tbody>
        <?php
        for ($i = 0; $i < count($dataArr); $i++)
        {
            if ($i == 0)
            {
                echo '<tr>';

                foreach ($dataArr[$i] as $key => $value)
                {
                    echo '<th>' . $key . '</th>';
                }
                
                echo '<th>actions</th>';
                
                echo '</tr>';
            }

            echo '<tr>';

            foreach ($dataArr[$i] as $value)
            {
                echo '<td>' . $value . '</td>';
            }

            echo
'<td><form action="' . Core::app()->createUrl('admin/modules/setting/') . '" method ="post">
  <fieldset>
    <input type="hidden" name="id_module" value="' . $dataArr[$i]['id'] . '">
    <button type="submit" class="btn btn-primary">Настройки</button>
  </fieldset>
</form></td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>