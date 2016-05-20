<?php 
	include_once('DB.class.php');

	$GET = strip_tags(trim($_GET['acao']));

	switch ($GET) {
		case 'addnot':
			$id_user = (int)$_GET['idu'];

			if(!empty($id_user) and is_numeric($id_user)){
				$data = date('Y-m-d H:i:s');
				$insert = DB::Conn()->query("INSERT INTO tb_notificacoes (id_user, status, data) VALUES ('$id_user', '0', '$data')");
				
				if($insert){
					echo 'Notificacion guardada';
				}else { echo 'error en insertar'; }
			}

			break;

		case 'verificar':

			$verificar = DB::Conn()->query("SELECT * FROM tb_notificacoes WHERE status = '0' ");
			$total = $verificar->rowCount();

			echo $total;

			break;

		case 'getnots' :
			$get = DB::Conn()->query("SELECT
				u.id, u.nome, 
				n.id as idn, n.id_user, n.status, n.data

				FROM tb_users u

				INNER JOIN tb_notificacoes n ON (n.id_user = u.id)

				ORDER BY n.id DESC
			");

			$li = '';

			while($rows = $get->fetch(PDO::FETCH_OBJ)){
				$li .= '<li class="n" id="'.$rows->idn.'">';
					$li .= '<div class="imgn"></div>'; 

					$li .= '<div class="contn">';
						$li .= '<span>'.$rows->nome.'</span> subio una providencia  <span>'.date('d/m/Y H:i', strtotime($rows->data)).'</span> ';
					$li .= '</div>'; 
 					
 					$vis   = ($rows->status == 0) ? 'vis' : 'vis2';
 					$title = ($rows->status == 0) ? 'no visualizado' : 'Visualizado';

					$li .= '<div class="'.$vis.'" id="'.$rows->idn.'" title="'.$title.'"></div>';
				$li .= '</li>';
			}

			echo $li;

			break;
		
		case 'vis':
			$idnot = (int)$_GET['idnot'];
			
			if(!empty($idnot) and is_numeric($idnot)){
				$atualiza = DB::Conn()->query("UPDATE tb_notificacoes SET status = 1 WHERE id = '$idnot' ");

				if($atualiza): echo 'Visualizado!'; endif;
			}
			break;

		default:
			echo 'Erro';
			break;
	} 
 