/**
 * unEscMark:
 *    Markdown記法のために、htmlspecialchars関数を一部無効にする。
 *   「```」（バッククオートが３つ連続）に囲まれた部分は、
 *    htmlspecialchars関数を無効にする。
 *      （例）
 *         ```                <== 無効のはじまり
 *         <?php
 *             phpinfo();
 *         ?>
 *         ```                <== 無効のおわり
 *    
 *    「>」は、どこであっても、htmlspecialchars関数を無効にする。
 *
 * Usage:
 *   $newtext = unEscMark(htmlspecialchars($text, ENT_QUOTE, "UTF-8"))
 *   $html = MarkdownExtra::defaultTransform($newtext);
 *   <html><body>
 *     <?php echo $html; ?>
 *   </body></html>
 *
 * Author:
 *     Seiichi Nukayama (c) 2018
 */
function unEscMark($str) {
	$flag = 0;
	$k = 0;
	$s = 0;  // `のカウント
	$newStr = '';
	for ($i = 0; $i < strlen($str); $i++) {
		// 1バイトをコピー
		$newStr[$k] = $str[$i];
		// もし、"`"（バッククオートなら）
		if ($str[$i] === '`') {
			$s++;
			if ($s === 3) {         // バッククオート3文字
				if ($flag === 0) {
					$flag = 1;
				} elseif ($flag === 1) {
					$flag = 0;
				}
				$s = 0;             // カウントをゼロにもどす
			}
		}
		// バッククオートが連続しなかったら
		if ($s > 0 && $str[$i] !== '`') { $s = 0; }
		
		// echo " s= $s";

		if ($flag === 1) {
			if (substr($str, $i, 4) === '&lt;') {
				$newStr[$k] = '<';
				$i = $i + 3;
			}
			/*
			elseif (substr($str, $i, 4) === '&gt;') {
				$newStr[$k] = '>';
				$i = $i + 3;
			}
			*/
			elseif (substr($str, $i, 4) === '&amp;') {
				$newStr[$k] = '&';
				$i = $i + 4;
			}
			elseif (substr($str, $i, 6) === '&quot;') {
				$newStr[$k] = '"';
				$i = $i + 5;
			}
			elseif (substr($str, $i, 6) === '&#039;') {
				$newStr[$k] = "'";
				$i = $i + 5;
			}
		}
		// > は、引用をあらわす(Markdown)
		if (substr($str, $i, 4) === '&gt;') {
			$newStr[$k] = '>';
			$i = $i + 3;
		}
		$k++;
	}
	return implode($newStr);  // 配列を文字列に変換して返す
}
