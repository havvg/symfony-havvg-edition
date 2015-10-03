Feature: Logging in to the application
    In order to utilize the new application
    As a user
    I need to be able to login

    Background:
        Given I am on "/login"

    Scenario: Logging in to application
        When I fill in the following:
            | Username | tester   |
            | Password | testpass |
         And I press "Login"
        Then print last response
        Then I should be on "/"
         And the response status code should be 200

    Scenario: Bad credentials error message
        When I fill in the following:
            | Username | tester    |
            | Password | wrongpass |
         And I press "Login"
        Then I should be on "/login"
         And the response status code should be 200
         And I should see text matching "Bad credentials."
