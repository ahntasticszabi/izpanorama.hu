<style>
#ures {
	position         : relative     ;
	top              : 5px          ;
	left             :-32px         ;
}

#szem {
	position         : relative     ;
	top              : 5px          ;
	left             :-32px         ;
}

#pipa {
	position         : relative     ;
	top              : 5px          ;
	left             :-32px         ;

	filter           : grayscale(1) ;
	opacity          : .25          ;
}

#figyelmeztetes {
	font-weight      : bold         ;
	color            : red          ;
}
</style>

<div style='text-align:center;' class='logreg_box' >
    <form sytle='margin:24px 48px; line-height:32px;' action='reg_wr.php' method='post' target="kisablak">
        <h1>IZ*PANORAMA</h1>
        <input type='email' name='umail' placeholder='Email' required>
		<img src='SRCIMG/white.png' id='ures' height=20>
        <input type='text' name='uname' placeholder='Username' required>
		<img src='SRCIMG/white.png' id='ures' height=20>
        <input type='password' name='pw1' id='pass' placeholder='Password' maxlength=40 onkeyup='egyezes();' onkeydown='CapsLock(event);' required>
        <img src='SRCIMG/eye0.png' id='szem' height=20 onclick='jelszomutat();'>

        <input type='password' name='pw2' id='pas2' placeholder='Confirm your password' maxlength=40 onkeyup='egyezes();' onkeydown='CapsLock(event);'>
        <img src='SRCIMG/nonequal.png' id='pipa' height=20><br>
        <span id='figyelmeztetes'></span><br>
        <input type='submit' value="Sign Up">
    </form>
</div>

<script>
    function jelszomutat()
    {
	    if( document.getElementById('pass').type=='password' )
	    {
            document.getElementById('pass').type = 'text'
            document.getElementById('szem').src  = 'SRCIMG/eye1.png'
	    }
	    else if( document.getElementById('pass').type=='text')
	    {
	        document.getElementById('pass').type = 'password'
	        document.getElementById('szem').src  = 'SRCIMG/eye0.png'
	    }
    }

    function egyezes()
    {
	    if( document.getElementById('pass').value=='' || document.getElementById('pas2').value=='' )
	    {
	        document.getElementById('pipa').src  = 'SRCIMG/nonequal.png'
	        document.getElementById('pipa').style.filter   = 'grayscale(1)'
	        document.getElementById('pipa').style.opacity  = .25
	    }
	    else
	    if( document.getElementById('pass').value!=document.getElementById('pas2').value )
	    {
	        document.getElementById('pipa').src  = 'SRCIMG/nonequal.png'
	        document.getElementById('pipa').style.filter   = 'grayscale(0)'
	        document.getElementById('pipa').style.opacity  =  1
	    }
	    else
	    {
	        document.getElementById('pipa').src  = 'SRCIMG/pipa.png'
	        document.getElementById('pipa').style.filter   = 'grayscale(0)'
	        document.getElementById('pipa').style.opacity  =  1
	    }
    }

    function CapsLock( esemeny )
    {
	if( esemeny.getModifierState('CapsLock') )
	    document.getElementById('figyelmeztetes').innerHTML = 'CapsLock on!'
	else
	    document.getElementById('figyelmeztetes').innerHTML = ''
    }

</script>