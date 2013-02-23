<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title></title>
	
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.css " media="all" />
    <link rel="stylesheet" href="styles/general.css" media="all" />
    <link rel="stylesheet" href="styles/main.css" media="all" />

    
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.1/html5shiv.js"></script>
	<![endif]-->

	<script type="text/template" id="login-template">
		<form action="#login" id="form-login" style="position:relative;top:30px;">
			<table class="special">
				<tr>
					<td>Username:</td>
					<td><input type="text" id="username" class="text" /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" id="password" class="text" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><button id="login" class="submit">Login</button></td>
				</tr>
			</table>
		</form>

	</script>

	<script type="text/template" id="welcome-template">

		<div class="breadcrumb">
			<ul>
				<li>www.mysite.com &gt;</li>
				<li><a href="#">CMS</a></li>
			</ul>
		</div>

		<div class="settings">
			<a href="#/pages" class="section page">
				<h4>Page Management</h4>
				<img src="images/settings.png" />
				<p>Add new pages, edit and delete existing pages on your site</p>
			</a>

			<a href="#/users" class="section user">
				<h4>User Management</h4>
				<img src="images/users.png" />
				<p>Add new user, edit and delete existing users who have access to this sites CMS</p>
			</a>

			<a href="#/personal" class="section personal">
				<h4>Your Settings</h4>
				<img src="images/personal.png" />
				<p>Edit your login information for this sites CMS</p>
			</a>

			<a href="#/logout" class="section logout">
				<h4>Logout</h4>
				<img src="images/logout.png" />
				<p>Logout of this sites CMS and return to the site</p>
			</a>
		</div>

	</script>

	<script type="text/template" id="pages-list-template">
		<div class="breadcrumb">
			<ul>
				<li>www.mysite.com &gt;</li>
				<li><a href="#/">CMS</a> &gt;</li>
				<li>Pages</li>
			</ul>
		</div>

		
		<div class="new-link"><a href="#/pages-new" class="new">Add New Page</a></div>
		<div class="clearer"></div>
		<table class="special">
			<tr>
				<th>Page Name</th>
				<th>Actions</th>
			</tr>
			<% _.each(pages,function(page) { %>
				<tr>
					<td><%= page.get('name') %></td>
					<td><a href="#/pages-edit/<%= page.id %>" class="edit" title="Edit Page"></a></td>
				</tr>
			<% }); %>
		</table>

	</script>

	<script type="text/template" id="users-list-template">
		<div class="breadcrumb">
			<ul>
				<li>www.mysite.com &gt;</li>
				<li><a href="#/">CMS</a> &gt;</li>
				<li>Users</li>
			</ul>
		</div>

		
		<div class="new-link"><a href="#/users-new" class="new">Add New User</a></div>
		<div class="clearer"></div>
		<table class="special">
			<tr>
				<th>Username</th>
				<th>Actions</th>
			</tr>
			<% _.each(users,function(user) { %>
				<tr>
					<td><%= user.get('username') %></td>
					<td><a href="#/users-edit/<%= user.id %>" class="edit" title="Edit User"></a></td>
				</tr>
			<% }); %>
		</table>

	</script>

	<script type="text/template" id="edit-page-template">
		<div class="breadcrumb">
			<ul>
				<li>www.mysite.com &gt;</li>
				<li><a href="#/">CMS</a> &gt;</li>
				<li><a href="#/pages">Pages</a>  &gt;</li>
				<% if (page) { %>
					<li>Update Page</li>
				<% } else { %>
					<li>Add Page</li>
				<% } %>
			</ul>
		</div>
		<form class="edit-page-form">
			
			<% if (page) { %>
				<input type="hidden" name="id" value="<%= page.id %>" />
				<button class="delete">Delete Page</button>
			<% } %>
			<legend><%= page ? 'Update' : 'Create' %> Page</legend>

			<p class="form-sub">General Information</p>
			<div class="form-row">
			<label>Page Name</label>
			<input type="text" name="name" class="text" value="<%= page ? page.get('name') : '' %>" />
			</div>

			<p class="form-sub">Meta Information</p>

			<div class="form-row">
			<label>Meta Keywords</label>
			<input type="text" name="meta_keywords" class="text" value="<%= page ? page.get('meta_keywords') : '' %>" />
			</div>

			<div class="form-row">
			<label>Meta Description</label>
			<input type="text" name="meta_description" class="text" value="<%= page ? page.get('meta_description') : '' %>" />
			</div>

			<p class="form-sub">Page Content</p>

			<div class="form-row">
			<label>Page Header</label>
			<input type="text" name="header" class="text" value="<%= page ? page.get('header') : '' %>"  />
			</div>

			<div class="form-row">
			<label>Page Content</label>
			<textarea name="content" class="text"><%= page ? page.get('content') : '' %></textarea>
			</div>

			<% if (page) { %>
				<button class="submit" type="submit">Update Page</button>
			<% } else { %>
				<button class="submit" type="submit">Add Page</button>
			<% } %>

			

		</form>
  </script>

  <script type="text/template" id="edit-user-template">
		<div class="breadcrumb">
			<ul>
				<li>www.mysite.com &gt;</li>
				<li><a href="#/">CMS</a> &gt;</li>
				<li><a href="#/users">Users</a>  &gt;</li>
				<% if (user) { %>
					<li>Update User</li>
				<% } else { %>
					<li>Add User</li>
				<% } %>
			</ul>
		</div>
		<form class="edit-user-form">
			
			<% if (user) { %>
				<input type="hidden" name="id" value="<%= user.id %>" />
				<button class="delete">Delete User</button>
			<% } %>
			<legend><%= user ? 'Update' : 'Create' %> User</legend>

			<p class="form-sub">General Information</p>
			<div class="form-row">
			<label>Username</label>
			<input type="text" name="username" class="text" value="<%= user ? user.get('username') : '' %>" />
			</div>

			<p class="form-sub">Optional Information</p>

			<div class="form-row">
			<label>Password</label>
			<input type="password" name="password" class="text" value="<%= user ? user.get('password') : '' %>" />
			</div>

			<div class="form-row">
			<label>Admin</label>
			<input type="checkbox" name="admin" <%= (user ? (user.get('admin') != '0' ? 'checked="checked"' : '') : '') %> value="1" />
			</div>

			<% if (user) { %>
				<button class="submit" type="submit">Update User</button>
			<% } else { %>
				<button class="submit" type="submit">Add User</button>
			<% } %>

			

		</form>
  </script>

</head>
<body>
		<header>
			<div class="container">
				<img src="images/web-dreams.png" style="float:right;" />
				<h1>Content Management System</h1>
				<div class="clearer"></div>
				
			</div>
		</header>

		<div class="container">

			<section id="section">
				
			</section>

		</div>

		<footer>
			
		</footer>
	</div>

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.3/underscore-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/backbone.js/0.9.9/backbone-min.js"></script>

	<script src="scripts/general.js"></script>
	<script src="scripts/base.js"></script>
</body>
</html>