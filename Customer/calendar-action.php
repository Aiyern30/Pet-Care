<?php
class Calendar {

    private $active_year, $active_month, $active_day;
    private $events = [];
    private $pet_id;

    public function __construct($date, $pet_id = null) {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
        $this->events = [];
        $this->pet_id = $pet_id;
    }

    public function add_event($txt, $date, $days = '', $color = '', $id = '', $source = '') {
        $color = $color ? ' ' . $color : $color;
        $this->events[] = [$txt, $date, $days, $color, $id, $source];
    }

    public function prev_month() {
        $month_offset = -1;
        $prev_month_url = date('Y-m-d', strtotime("$month_offset months", strtotime($this->active_year . '-' . $this->active_month . '-01')));
        $prev_month_url .= '&petid=' . urlencode($_GET['petid'] ?? '');       
        return $_SERVER['PHP_SELF'] . '?date=' . $prev_month_url;
    }

    public function next_month() {
        $month_offset = 1;
        $next_month_url = date('Y-m-d', strtotime("$month_offset months", strtotime($this->active_year . '-' . $this->active_month . '-01')));        
        $next_month_url .= '&petid=' . urlencode($_GET['petid'] ?? '');
        return $_SERVER['PHP_SELF'] . '?date=' . $next_month_url;
    }

    public function __toString() {
        $current_year = date('Y');
        $current_month = date('m');
        $current_day = date('d');
        // $current_date = $this->active_year . '-' . $this->active_month . '-' . $current_day;
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        $html = '<div class="calendar">';
        $html .= '<div class="header">';
        $html .= '<div class="month-year">';
        $html .= '<a class="prev" href="' . $this->prev_month() . '" style="text-decoration: none; color: white;">&#10094;</a>&nbsp;&nbsp;';
        $html .= date('F Y', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));
        $html .= '&nbsp;&nbsp;<a class="next" href="' . $this->next_month() . '" style="text-decoration:none; color: white;">&#10095;</a>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="days">';
        foreach ($days as $day) {
            $html .= '
                <div class="day_name">
                    ' . $day . '
                </div>
            ';
        }
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    ' . ($num_days_last_month-$i+1) . '
                </div>
            ';
        }
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
            if ($i == $current_day && $this->active_day && $this->active_month == $current_month && $this->active_year == $current_year && $i != 1) {
                $selected = ' selected';
            }
            $html .= '<div class="day_num' . $selected . '">';
            $html .= '<span>' . $i . '</span>';
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2]-1); $d++) {
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $html .= '<div class="event' . $event[3] . '" onclick="showEventDetails(\'' . $event[0] . '\', \'' . $event[1] . '\', \'' . $event[2] . '\', \'' . $event[4] . '\', \'' . $event[5] . '\')">';
                        $html .= $event[0];
                        $html .= '</div>';
                    }
                }
            }
            $html .= '</div>';
        }
        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore">
                    ' . $i . '
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}
?>

<script>
    function showEventDetails(event, date, duration, eventId, source) {
        var eventDetails = 'Event: ' + event + '\nStart Date: ' + date + '\nDuration: ' + duration;
        var confirmation = confirm(eventDetails + '\n\nAre you sure to delete this event?');
        if (confirmation) {
            var deleteUrl = '';
            if (source === 'schedule') {
                deleteUrl = 'delete.php?schedule_id=' + eventId;
            } else if (source === 'event') {
                deleteUrl = 'delete.php?event_id=' + eventId;
            }
            window.location.href = deleteUrl;
        }
    }
</script>