<?php

namespace functions;

/**
 * get_template_part() を、try ~ chatch 構文の中で実行するラッパー関数
 */
function template(string $slug, string $name = \null, array $args = []): void
{
  try {
    if (get_template_part($slug, $name, $args) === false) throw new \Exception('get_template_part(' . $slug . ')に失敗', 1);
  } catch (\Throwable $th) {
    echo $th->getMessage();
  }
}
