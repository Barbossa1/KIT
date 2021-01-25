<?php
function changeParams($url, $value)
{
    $parse = parse_url($url);
    parse_str($parse['query'], $params);

    $result = array_filter($params, function ($pValue) use ($value) {
        return $pValue !== (string)$value;
    });

    return changeUrl($parse['host'], $parse['path'], $result, $parse['scheme']);
}

function changePath($url)
{
    $parse = parse_url($url);
    parse_str($parse['query'], $params);

    return changeUrl($parse['host'], '', $params, $parse['scheme']);
}

function sortParams($url)
{
    $parse = parse_url($url);
    parse_str($parse['query'], $params);
    asort($params);

    return changeUrl($parse['host'], '', $params, $parse['scheme']);
}

function addParams($url, $name, $value)
{
    $parse = parse_url($url);
    parse_str($parse['query'], $params);
    $params[$name] = $value;

    return changeUrl($parse['host'], '', $params, $parse['scheme']);
    //..
}

function changeUrl($host, $path = '', $params = [], $scheme = 'http')
{
    return $scheme . '://' . $host . '/' . $path . '?' . http_build_query($params);
}

function change()
{

    $string = 'https://www.somehost.com/test/index.html?param1=4&amp;param2=3&amp;param3=2&amp;param4=1&amp;param5=3';
    $newParam = '/test/index.html';

    $filtered = changeParams($string, 3);
    $sorted = sortParams($filtered);
    $pathRemoved = changePath($sorted);
    $updated = addParams($pathRemoved, 'url', $newParam);

    return $updated;
}

echo change();