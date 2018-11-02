<?php

class GoogleMapPointLocation
{
    var $pointOnVertex = true; // Check if the point sits exactly on one of the vertices
    const POLYGON_GARDEN_RING = '55.771239,37.596347
55.774328,37.622440
55.772011,37.636172
55.769694,37.644412
55.762740,37.654025
55.751922,37.655399
55.741100,37.649905
55.734142,37.636172
55.729503,37.623813
55.730276,37.600467
55.736462,37.588107
55.750376,37.585361
55.761195,37.585361';
    const POLYGON_TTK = '55.792283,37.575748
55.792669,37.616946
55.792283,37.632739
55.793441,37.647845
55.793441,37.652652
55.785334,37.663638
55.777225,37.678744
55.768342,37.690417
55.754820,37.693851
55.742453,37.697284
55.730469,37.707584
55.725056,37.711017
55.708038,37.665698
55.704556,37.658145
55.705716,37.619006
55.701460,37.613513
55.709585,37.583301
55.723509,37.551715
55.739748,37.533862
55.753274,37.530429
55.771045,37.540729';
    const POLYGON_MKAD = '55.848409,37.391040
55.799810,37.378680
55.758877,37.366321
55.704749,37.391040
55.648222,37.450091
55.611008,37.484424
55.583075,37.568195
55.574536,37.682178
55.601699,37.754962
55.649771,37.826373
55.712486,37.838733
55.782052,37.841479
55.830674,37.830493
55.879235,37.730243
55.899258,37.628619
55.911575,37.544849
55.880776,37.432239
55.869990,37.407519';

    function pointLocation()
    {
    }


    function pointInPolygon($point, $polygon, $pointOnVertex = true)
    {
        $this->pointOnVertex = $pointOnVertex;

        // Transform string coordinates into arrays with x and y values
        $point = self::pointStringToCoordinates($point);
        $vertices = array();
        foreach ($polygon as $vertex) {
            $vertices[] = self::pointStringToCoordinates($vertex);
        }

        // Check if the point sits exactly on a vertex
        if ($this->pointOnVertex == true and $this->pointOnVertex($point, $vertices) == true) {
            return true;
        }

        // Check if the point is inside the polygon or on the boundary
        $intersections = 0;
        $vertices_count = count($vertices);

        for ($i = 1; $i < $vertices_count; $i++) {
            $vertex1 = $vertices[$i - 1];
            $vertex2 = $vertices[$i];
            if ($vertex1['y'] == $vertex2['y'] and $vertex1['y'] == $point['y'] and $point['x'] > min($vertex1['x'], $vertex2['x']) and $point['x'] < max($vertex1['x'], $vertex2['x'])) { // Check if point is on an horizontal polygon boundary
                return true;
            }
            if ($point['y'] > min($vertex1['y'], $vertex2['y']) and $point['y'] <= max($vertex1['y'], $vertex2['y']) and $point['x'] <= max($vertex1['x'], $vertex2['x']) and $vertex1['y'] != $vertex2['y']) {
                $xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x'];
                if ($xinters == $point['x']) { // Check if point is on the polygon boundary (other than horizontal)
                    return true;
                }
                if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters) {
                    $intersections++;
                }
            }
        }
        // If the number of edges we passed through is even, then it's in the polygon.
        if ($intersections % 2 != 0) {
            return true;
        } else {
            return false;
        }
    }


    function pointOnVertex($point, $vertices)
    {
        foreach ($vertices as $vertex) {
            if ($point == $vertex) {
                return true;
            }
        }
        return false;
    }


    static function pointStringToCoordinates($pointString)
    {
        $coordinates = explode(',', $pointString);
        return array("x" => $coordinates[0], "y" => $coordinates[1]);
    }

    /**
     * Calculate Distance between two points
     * @param float $map_latitude1
     * @param float $map_longitude1
     * @param float $map_latitude2
     * @param float $map_longitude2
     * @return int distance in kilometers
     */
    public static function GetDistanceInKilometers($map_latitude1, $map_longitude1, $map_latitude2, $map_longitude2){
        $R = 6371; // km
        $dLat = deg2rad($map_latitude2-$map_latitude1);
        $dLon = deg2rad($map_longitude2-$map_longitude1);
        $lat1 = deg2rad($map_latitude1);
        $lat2 = deg2rad($map_latitude2);

        $a = sin($dLat/2) * sin($dLat/2) + sin($dLon/2) * sin($dLon/2) * cos($lat1) * cos($lat2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $d = $R * $c;

        return $d;
    }

    public static function FindPolygonCenter($polygon){
        $vertices = array();
        $polygon = explode("\n", trim($polygon));
        foreach ($polygon as $vertex) {
            $vertices[] = self::pointStringToCoordinates($vertex);
        }
        $vertices_count = count($vertices);

        $x = $y = 0;
        for ($i = 0; $i < $vertices_count; $i++) {
            $x += $vertices[$i]['x'];
            $y += $vertices[$i]['y'];
        }

        $x = $x/$vertices_count;
        $y = $y/$vertices_count;
        return array('x'=>$x, 'y'=>$y);
    }
}
