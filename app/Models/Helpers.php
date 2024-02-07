<?php

namespace App\Models;

use App\Models\Tickets\Ticket;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use \Carbon\Carbon;
use Carbon\CarbonInterval;
use DateTime;

class Helpers
{
	/**
     * Toma un texto como parámetro y lo retorna
     * en minúscula y capitaliza la primera letra
     *
     * @param  string $str
     * @return string
     */
	public static function capitalizarTexto($str)
	{
		return ucfirst(mb_strtolower($str));
	}

	/**
     * Toma un texto como parámetro y lo retorna
     * en minúscula y capitaliza la primera letra
     * de cada palabra
     *
     * @param  string $str
     * @return string
     */
	public static function capitalizarTextoCompleto($str)
	{
		return ucwords(mb_strtolower($str));
    }

    public static function MayusculaTextoCompleto($str)
	{
		return ucwords($str);
	}

    /**
     * Valida que la fecha sea manipulable con Carbon
     *
     * @param  string $fecha
     * @return string
     */
    public static function validarFecha($fecha)
    {
        try {
            if (is_float($fecha) || is_numeric($fecha))
                $fecha = Carbon::parse(Date::excelToDateTimeObject($fecha))->toDateString();
            else {
                $fecha = str_replace('/', '-', $fecha);
                $fecha = Carbon::parse($fecha)->toDateString();
            }
        } catch (\Exception $e) {
            $error = 'El formato de la fecha no es correcto.';
            throw new \Exception($error);
        }
        return $fecha;
    }

    /**
     * Valida que la hora sea manipulable con Carbon
     *
     * @param  string $hora
     * @return string
     */
    public static function validarHora($hora)
    {
        try {
            if (is_float($hora) || is_numeric($hora))
                $hora = Carbon::parse(Date::excelToDateTimeObject($hora))->toTimeString();
            else
                $hora = Carbon::parse($hora)->toTimeString();
        } catch (\Exception $e) {
            $error = 'El formato de la hora no es correcto.';
            throw new \Exception($error);
        }
        return $hora;
    }

    /**
     * Dada una fecha, retorna el día de la semana
     *
     * @param  string $fecha
     * @return string
     */
    public static function diaSemanaPorFecha($fecha)
    {
        $diasSemana = [
            0 => 'Domingo',
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado'
        ];
        $fecha = Self::validarFecha($fecha);
        return $diasSemana[Carbon::parse($fecha)->dayOfWeek];
    }

    /**
     * Dada una fecha, retorna el mes del año
     *
     * @param  string $fecha
     * @return string
     */
    public static function mesPorFecha($fecha)
    {
        $meses = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];

        $fecha = Self::validarFecha($fecha);
        return $meses[Carbon::parse($fecha)->month];
    }


     /**
     * Genera el nombre completo del empleado
     *
     * @param  Request $request
     * @return string
    */

    public static function generarNombreCompleto($primerNombre,$segundoNombre,$primerApellido,$segundoApellido)
    {
        return Helpers::MayusculaTextoCompleto($primerNombre) . ' ' .
            Helpers::MayusculaTextoCompleto($segundoNombre) . ' ' .
            Helpers::MayusculaTextoCompleto($primerApellido) . ' ' .
            Helpers::MayusculaTextoCompleto($segundoApellido);
    }

    /**
     * Convierte la fecha modo letura
     *
     * @param  Request $fecha
     * @return string
    */
    public static function formatoFechaLectura($fecha)
    {
        if ($fecha) {
            $meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
            $dias = array('Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo');
            $diaLetra = Carbon::parse($fecha)->format('N');
            $diaNumero = Carbon::parse($fecha)->format('d');
            $mes = Carbon::parse($fecha)->format('m');
            $anio = Carbon::parse($fecha)->format('Y');
            for ($i=0; $i < count($meses); $i++) {
                if(($i+1) == $mes){
                    $mes = $meses[$i];
                }
            }
            for ($i=0; $i < count($dias); $i++) {
                if(($i+1) == $diaLetra){
                    $diaLetra = $dias[$i];
                }
            }

            return $diaLetra.' '.$diaNumero.' de '.$mes.' de '.$anio;
        }

    }

    public static function getNombreComputador()
	{
		return gethostname();
	}

    /* Estas funciones son helpers propios */

	public static function getNavegador()
	{
		$objeto = new \ArrayObject();
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";

		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}

		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
			$bname = 'Internet Explorer';
			$ub = "MSIE";
		}
		elseif(preg_match('/Firefox/i',$u_agent)){
			$bname = 'Mozilla Firefox';
			$ub = "Firefox";
		}
		elseif(preg_match('/Chrome/i',$u_agent)){
			$bname = 'Google Chrome';
			$ub = "Chrome";
		}
		elseif(preg_match('/Safari/i',$u_agent)){
			$bname = 'Apple Safari';
			$ub = "Safari";
		}
		elseif(preg_match('/Opera/i',$u_agent)){
			$bname = 'Opera';
			$ub = "Opera";
		}
		elseif(preg_match('/Netscape/i',$u_agent)){
			$bname = 'Netscape';
			$ub = "Netscape";
		}

		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

		if (!preg_match_all($pattern, $u_agent, $matches)) {}

		$i = count($matches['browser']);

		if ($i != 1) {
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}else {
				$version= $matches['version'][1];
			}
		}else {
			$version= $matches['version'][0];
		}

		if ($version==null || $version=="") {$version="?";}

		$objeto->userAgent = $u_agent;
		$objeto->name      = $bname;
		$objeto->version   = $version;
		$objeto->platform  = $platform;
		$objeto->pattern   = $pattern;

		return $objeto;
	}

    public static function calcularDiffHoursHmS($hora1, $hora2) {
		$horaInicio= Carbon::parse($hora1);
		$horaFin= Carbon::parse($hora2);
        $calcularDias= $horaFin->diff($horaInicio)->d;
		$calcularHoras= $horaFin->diff($horaInicio)->h;
        if ($calcularDias >0) {
            $calcularHoras=($calcularDias*24) +$calcularHoras;
        }
		$totalCaracteresH=strlen($calcularHoras);
		$calcularMinutos= $horaInicio->diff($horaFin)->i;
		$totalCaracteresM=strlen($calcularMinutos);
		$calcularSegundos= $horaInicio->diff($horaFin)->s;
		$totalCaracteresS=strlen($calcularSegundos);
		$horas= $totalCaracteresH > 1 ? $calcularHoras : '0'.$calcularHoras;
		$minutos= $totalCaracteresM > 1 ? $calcularMinutos : '0'.$calcularMinutos;
		$segundos= $totalCaracteresS > 1 ? $calcularSegundos : '0'.$calcularSegundos;
		return $horas.':'.$minutos.':'.$segundos;
	}


    public static function sumaHora($hour1, $hour2) {
		list( $h1, $m1, $s1 ) = explode( ':', $hour1 );
		list( $h2, $m2, $s2 ) = explode( ':', $hour2 );

		$st = $s1+$s2;
        $minutosAdd=0;
		if($st > 59){
            $minutosAdd=intval(floor($st/60));
			$st = $st - 60 * $minutosAdd;
            //agrego minutos que salen de los segundos a los minutos de la hora 2
			$m1 = $m1 + $minutosAdd;
		}

        //calcular minutos totales
		$mt = $m1 + $m2;
        $hoursAdd=0;
		if($mt > 59){
            $hoursAdd=intval(floor($mt/60));
            $mt = $mt - 60 * $hoursAdd;
			$h1 = $h1 + $hoursAdd;
		}

		$ht = $h1 + $h2;
		$c=0;


		if ($ht < 10){
			$ht = $c.$ht;
		}

		if ($mt < 10){
			$mt = $c.$mt;
		}

		if ($st < 10){
			$st = $c.$st;
		}
		return($ht.":".$mt.":".$st);
    }

    public static function getIconFile($extension) {
        $icon='far fa-file-pdf';
        $color='danger';

        if ($extension=='xls' || $extension=='xlsx') {
            $icon='far fa-file-excel';
            $color='success';
        } else if($extension=='docx') {
            $icon='far fa-file-word';
            $color='info';
        } else if($extension=='jpg' || $extension=='jpeg' || $extension=='png' || $extension=='tif' || $extension=='bmp' || $extension=='gif') {
            $icon='fas fa-image';
            $color='primary';
        }else if($extension=='pdf') {
            $icon='far fa-file-pdf';
            $color='danger';
        } else {
            $icon='fas fa-file-alt';
            $color='warning';
        }
        return [
            'icon' => $icon,
            'color' => $color
        ];
    }

    public static function calcularDisponibilidadTicket($ticketId)
    {
        $ticket = Ticket::find($ticketId);

        // Calcular fecha de inicio
        $fechaInicio = Carbon::parse($ticket->date . ' 00:00:00');

        // Calcular la disponibilidad del ticket en función de su estado y tiempo de reloj
        if ($ticket->state_clock == 'Corriendo' && $ticket->time_clock == null) {
            // Caso 1: el ticket está corriendo pero nunca se ha detenido el reloj
            $disponibilidad = 0; // El ticket no ha estado inactivo, por lo que su disponibilidad es del 100%
        } elseif ($ticket->state_clock == 'Corriendo' && $ticket->time_clock != null) {
            // Caso 2: el ticket está corriendo y sí tiene time_clock
            //tiempo total del reloj
            $timeActually= Carbon::now();
            $timeClock=Ticket::calculateTimeClock($timeActually, $ticket);
            // Se calcula el tiempo total en que el ticket ha estado disponible (hasta el momento actual)
            $tiempoTotalDisponible = $fechaInicio->diffInSeconds(Carbon::now());
            $fechaFin = $timeActually;

            if ($tiempoTotalDisponible <= 0) {
                $disponibilidad = 0; // El ticket no ha estado disponible, por lo que su disponibilidad es del 0%
            } else {
                // Calcular tiempo detenido del reloj
                $tiempoDetenido = 0;
                list($horas, $minutos, $segundos) = explode(':', $timeClock);
                $tiempoDetenido += $horas * 3600 + $minutos * 60 + $segundos;
                $tiempoDisponible = $tiempoTotalDisponible - $tiempoDetenido;
                $disponibilidad = round(($tiempoDisponible / $tiempoTotalDisponible) * 100.0, 2);
            }

        } elseif ($ticket->state_clock == 'Detenido') {
            // Caso 3: el ticket está detenido
            $fechaFin = Carbon::parse($ticket->datetime_clock);
            $tiempoTotalDisponible = $fechaInicio->diffInSeconds($fechaFin);
            // Se calcula el tiempo total en que el ticket ha estado disponible
            if ($tiempoTotalDisponible <= 0) {
                $disponibilidad = 0; // El ticket no ha estado disponible, por lo que su disponibilidad es del 0%
            } else {
                // Calcular tiempo detenido del reloj
                list($horas, $minutos, $segundos) = explode(':', $ticket->time_clock);
                $tiempoDetenido = $horas * 3600 + $minutos * 60 + $segundos;

                $tiempoDisponible = $tiempoTotalDisponible - $tiempoDetenido;
                $disponibilidad = ($tiempoDisponible / $tiempoTotalDisponible) * 100.0;
            }
        } else {
            // Estado desconocido
            $disponibilidad = null;
        }
        // Redondear la disponibilidad a 2 decimales
        $disponibilidad = round($disponibilidad, 2);

        // Devolver el porcentaje de disponibilidad del ticket
        return $disponibilidad;
    }
}
