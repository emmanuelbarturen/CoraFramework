<?php
if(Session::has('msg')){
    print Session::getflash('msg');
}