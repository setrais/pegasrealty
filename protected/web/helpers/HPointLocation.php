<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HPointLocation
 *
 * @author setrais
 */
class HPointLocation {
    
    var $pointOnVertex = true; // Check if the point sits exactly on one of the vertices

    function HPointLocation($point, $polygon, $pointOnVertex = true) {
        
        $this->pointOnVertex = $pointOnVertex;
        
        // Transform string coordinates into arrays with x and y values
        $point = $this->pointStringToCoordinates($point);
        $vertices = array(); 
        foreach ($polygon as $vertex) {
            $vertices[] = $this->pointStringToCoordinates($vertex); 
        }
        
        // Check if the point sits exactly on a vertex
        if ($this->pointOnVertex == true and $this->pointOnVertex($point, $vertices) == true) {
            return "vertex";
        }
        
        // Check if the point is inside the polygon or on the boundary
        $intersections = 0; 
        $vertices_count = count($vertices);
    
        for ($i=1; $i < $vertices_count; $i++) {
            $vertex1 = $vertices[$i-1]; 
            $vertex2 = $vertices[$i];
            if ($vertex1['y'] == $vertex2['y'] and $vertex1['y'] == $point['y'] and $point['x'] > min($vertex1['x'], $vertex2['x']) and $point['x'] < max($vertex1['x'], $vertex2['x'])) { // Check if point is on an horizontal polygon boundary
                return "boundary";
            }
            if ($point['y'] > min($vertex1['y'], $vertex2['y']) and $point['y'] <= max($vertex1['y'], $vertex2['y']) and $point['x'] <= max($vertex1['x'], $vertex2['x']) and $vertex1['y'] != $vertex2['y']) { 
                $xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x']; 
                if ($xinters == $point['x']) { // Check if point is on the polygon boundary (other than horizontal)
                    return "boundary";
                }
                if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters) {
                    $intersections++; 
                }
            } 
        } 
        // If the number of edges we passed through is even, then it's in the polygon. 
        if ($intersections % 2 != 0) {
            return "inside";
        } else {
            return "outside";
        }
    }

    
    
    function pointOnVertex($point, $vertices) {
        foreach($vertices as $vertex) {
            if ($point == $vertex) {
                return true;
            }
        }
    
    }
        
    
    function pointStringToCoordinates($pointString) {
        $coordinates = explode(",", $pointString);
        return array("x" => $coordinates[0], "y" => $coordinates[1]);
    }

    function example() {
        /*** Example ***/
        $pointLocation = new HPointLocation();
        $points = array("30 19", "0 0", "10 0", "30 20", "11 0", "0 11", "0 10", "30 22", "20 20");
        $polygon = array("10 0", "20 0", "30 10", "30 20", "20 30", "10 30", "0 20", "0 10", "10 0");
        // The last point's coordinates must be the same as the first one's, to "close the loop"
        foreach($points as $key => $point) {
            echo "$key ($point) is " . $pointLocation->pointInPolygon($point, $polygon) . "<br>";
        }    
    } 
}
