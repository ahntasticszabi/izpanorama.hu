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

#figyelmeztetes {
	font-weight      : bold         ;
	color            : red          ;
}
</style>

<div style='text-align:center;' class='logreg_box' >
    <form sytle='margin:24px 48px; line-height:32px;' action='login_wr.php' method='post' target='kisablak'>
        <h1>IZ*PANORAMA</h1>
        <input type='text' name='user' placeholder='Email or username'>
        <img src='SRCIMG/white.png' id='ures' height=20>
        <input type='password' name='pw' id='pass' placeholder='Password' onkeyup='egyezes();' onkeydown='CapsLock(event);'>
        <img src='SRCIMG/eye0.png' id='szem' height=20 onclick='jelszomutat();'><br>
        <span id='figyelmeztetes'></span><br>
        <input type='submit' value="Log In">
        <input type="button" value="Create an account" onclick='location.href="./?p=reg"'>
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

    function CapsLock( esemeny )
    {
	if( esemeny.getModifierState('CapsLock') )
	    document.getElementById('figyelmeztetes').innerHTML = 'CapsLock on!'
	else
	    document.getElementById('figyelmeztetes').innerHTML = ''
    }

</script>