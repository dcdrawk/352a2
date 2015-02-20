<md-content md-theme="default">
  <h1 class="heading">Member Registration</h1>
  <section id="registerForm" layout="row" layout-align="center center">
    <form action="#/register-process" method="post">
      <div class="inputSection" layout="row" layout-wrap>
        <div flex="50">
          First Name:
        </div>
        <div flex="50">
          <input type="text" name="firstName" value="" />
        </div>
        <div flex="50">
          Last Name:
        </div>
        <div flex="50">
          <input type="text" name="lastName" value="" />
        </div>
        <div flex="50">
          Email:
        </div>
        <div flex="50">
          <input type="text" name="email" value="" />
        </div>
        <div flex="50">
          Experience:
        </div>
        <div flex="50">
          <select value="experience">
            <option value="Not Selected">-Select-</option>
            <option value="Beginner">Beginner</option>
            <option value="Intermediate">Intermediate</option>
            <option value="Expert">Expert</option>
          </select>
        </div>
        <div flex="50">
        </div>
        <div flex="50">
          <input type="submit" id="submitBtn" type="submit" name="submit" value="Submit" />
        </div>
      </div>
    </form>

  </section>
</md-content>
