<div id="pageTitle" class="titleBar" layout="row">
  <h2>Login</h2>
</div>
<md-content class="md-padding" md-theme="default">
  <section layout="row" layout-sm="column" layout-align="center center">

    <form id="loginForm" flex="100" layout="column" name="loginForm" class="form-horizontal" role="form">

      <md-input-container flex="100">
        <label class="placeholderLabel">User Name</label>
        <input type="text" name="username" ng-model="login.username"  required>
        <div ng-messages="loginForm.email.$error">
          <div ng-message="required">This is required.</div>
        </div>
      </md-input-container>

      <md-input-container flex="100">
        <label class="placeholderLabel">Password</label>
        <input type="password" name="password" ng-model="login.password" required>
        <div ng-messages="loginForm.password.$error">
          <div ng-message="required">This is required.</div>
        </div>
      </md-input-container>

      <md-button id="loginBtn" class="md-raised md-primary" type="submit" ng-click="doLogin(login)" flex="50" data-ng-disabled="loginForm.$invalid"><span>Login</span></md-button>
      <md-button id="signupBtn" class="md-raised" type="submit" ng-click="go('/signup')" flex="50"><span>Sign up</span></md-button>
    </form>

  </section>
</md-content>
