<?php

function create($model, $override = [], $count = null) {
   return factory($model, $count)->create($override);
}

function raw($model, $override = [], $count = null) {
    return factory($model, $count)->raw($override);
}

function make($model, $override = [], $count = null) {
    return factory($model, $count)->make($override);
}
