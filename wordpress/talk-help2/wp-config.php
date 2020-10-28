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
// define( 'DB_NAME', 'amand934_talk2' );
define( 'DB_NAME', 'talkhelp' );

/** Usuário do banco de dados MySQL */
// define( 'DB_USER', 'amand934_talkhelp' );
define( 'DB_USER', 'talkhelp' );

/** Senha do banco de dados MySQL */
// define( 'DB_PASSWORD', 'y40oszH3rmX5' );
define( 'DB_PASSWORD', 'talkhelp' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
// define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '{lACnCB ?2Y7se,n-?s%t}A{pD(74XqGP[21%C(q{J>I!FR;y<6VL|%SAwF4%Zgl' );
define( 'SECURE_AUTH_KEY',  '?vrgi`JQN#k,K3{ mjpV ^n_c:|4Z:9F(0)poS1Nu`bbK<r#$)nPoPu!G:E~5u`p' );
define( 'LOGGED_IN_KEY',    '<7gm=UUDT2ez(Pcpqu^A!}U6WtG_M&<a*^3OBlfjO{iIq*pG$grvj7z0V OD.EUI' );
define( 'NONCE_KEY',        '#A?ksuF66r,B_MiMO>=fDBSgo#cej]>{j)Ppgz~jfm+`C~!c9Qq{0_:<[D)V74i|' );
define( 'AUTH_SALT',        '^C#iVD/otp#3hQ[#yXq!3a3lE)S?ps^UL^},OO4=$,BCa<@TA`/~&Z!bUWg([|2u' );
define( 'SECURE_AUTH_SALT', '>BUSR[&SyAuxM0voDH%s|b]xhA.Pcbp6_|vsY%8W+.iLC80YZ%xj}GOD>$|E c)i' );
define( 'LOGGED_IN_SALT',   '6pR<ltTM9!%D`8^pdo5;-[JD>P%Y73qzUM<$5%#{JJ4p44=a_[CORJOI*!V_DS(b' );
define( 'NONCE_SALT',       'R8-p;sOxkaI:;5sWT<19Pt@KFu55iqyXXT4>z?vkc0Ud#>vi<>L{Nj#v+Xq]/sfI' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'kl_';

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
