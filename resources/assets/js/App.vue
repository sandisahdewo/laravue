<template>
	<div>
		<div class="navbar navbar-default navbar-static-top">
			<div class="container">
	            <div class="navbar-header">
	        		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
	                    <span class="sr-only">Toggle Navigation</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>
	            </div>
	            <div class="collapse navbar-collapse" id="app-navbar-collapse">
		            <ul class="nav navbar-nav">
		                <li><router-link to="/item">Item</router-link></li>
		                <li><router-link to="/category/table">Category</router-link></li>
		            </ul>
                    <ul class="nav navbar-nav navbar-right">
	                    <li><router-link to="/login">Login</router-link></li>
	                    <li><router-link to="/register">Register</router-link></li>
	                </ul>
		        </div>
	        </div>
        </div>
        <div class="container">
        	<router-view></router-view>
        </div>
	</div>
</template>