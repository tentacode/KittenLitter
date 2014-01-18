Feature: I should see a lot of cute kittens on the front page
    Background:
        Given there is 20 cats

    Scenario: Kittens as listed in the front page
        Given I am on "/"
        Then I should see "Meow, World!"
        And I should see 9 cats out of 20