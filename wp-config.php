<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'pupti' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'i{ xnNU;+7X%tdmk)!VE+zq50cz|k~{(Hhm0Cp{$VOE~+DK9xAEQxYVZ2H>=%;.t' );
define( 'SECURE_AUTH_KEY',  'wEW@Ewg]R}>7./?FJkp:7!mRN/g`},3(5H^J~7pq#J pBYx|F4E~U7LXF0k6i5W>' );
define( 'LOGGED_IN_KEY',    'Tf=WCt~bJK|H4%f#:ZU)3M*)01R>P@R^4lz0A4?$0?.L13/8H?>h):#`a4I>_<JS' );
define( 'NONCE_KEY',        '*Kh1Z9,6s2t&l.)M.y2yV<S]>vP4nUK=!0ZhId:[hD{aLCMR@P6MBnUI/KkQMc;N' );
define( 'AUTH_SALT',        '9]IpByS {z+SI0.3R3wmybUE3lmQ/qp7~_R@uV$|A5;xQjFfhnTS#^Vd<kuwA@4Y' );
define( 'SECURE_AUTH_SALT', '>:7(V96!|k4d,!&J)gS+&g`/cZDCS`Ps~*iso+MQ{1r;2r6-}^smVPk#4|_>Ucdp' );
define( 'LOGGED_IN_SALT',   's&tD2y34bWLgb<;07Ew|7|8GDxeF*|adt,YZY3l9&)q*B9G@XT(J/sM`hXdT+*/E' );
define( 'NONCE_SALT',       '5y?6[b^5|#j<37/B:4McB(@2<!B$=$n@}G~t8P}(saR?kwcN[6<8/kU]L9]&db=d' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
