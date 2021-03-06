<?php
/**
 * @file
 * Template to display a view as a calendar day, grouped by time
 * and optionally organized into columns by a field value.
 *
 * @see template_preprocess_calendar_day.
 *
 * $rows: The rendered data for this day.
 * $rows['date'] - the date for this day, formatted as YYYY-MM-DD.
 * $rows['datebox'] - the formatted datebox for this day.
 * $rows['empty'] - empty text for this day, if no items were found.
 * $rows['all_day'] - an array of formatted all day items.
 * $rows['items'] - an array of timed items for the day.
 * $rows['items'][$time_period]['hour'] - the formatted hour for a time period.
 * $rows['items'][$time_period]['ampm'] - the formatted ampm value, if any for a time period.
 * $rows['items'][$time_period][$column]['values'] - An array of formatted
 *   items for a time period and field column.
 *
 * $view: The view.
 * $columns: an array of column names.
 * $min_date_formatted: The minimum date for this calendar in the format YYYY-MM-DD HH:MM:SS.
 * $max_date_formatted: The maximum date for this calendar in the format YYYY-MM-DD HH:MM:SS.
 *
 * The width of the columns is dynamically set using <col></col>
 * based on the number of columns presented. The values passed in will
 * work to set the 'hour' column to 10% and split the remaining columns
 * evenly over the remaining 90% of the table.
 */
?>
<div class="calendar-calendar"><div class="day-view">
<table class="table full">
  <colgroup>
    <col width="<?php print $first_column_width?>%"></col>
    <?php foreach ($columns as $column): ?>
    <col width="<?php print $column_width; ?>%"></col>
    <?php endforeach; ?>
  </colgroup>
  <thead>
    <tr>
      <th class="calendar-dayview-hour"><?php print $by_hour_count > 0 ? t('Time') : ''; ?></th>
      <?php foreach ($columns as $column):
      ?>
      <th class="calendar-agenda-items"><?php print $column; ?></th>
      <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
    <?php //dpm($rows['items']); ?>

    <?php foreach ($rows['items'] as $key => $hour): ?>
      <tr class="<?php print $hour['classes']; ?>">
        <td class="calendar-agenda-hour">
          <span class="calendar-hour">
            <?php print date('g:i', strtotime($key)); ?>
            <?php /*if($key == '05:00:00'){
              print "Overnight"; }
              else {
                print date('g:i', strtotime($key));
              }*/
            ?>
          </span>
          <span class="calendar-ampm">
            <?php print $hour['ampm']; ?>
            <?php /*if($key != '05:00:00'){
              print $hour['ampm'];
            }*/ ?>
          </span>
        </td>
        <?php foreach ($columns as $column): ?>
          <td class="calendar-agenda-items single-day">
            <div class="calendar">
            <div class="inner">
              <?php print isset($hour['values'][$column]) ? implode($hour['values'][$column]) : '&nbsp;'; ?>
            </div>
            </div>
          </td>
        <?php endforeach; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div></div>
