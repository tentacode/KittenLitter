Feature: I should see a lot of cute kittens on the front page

    Scenario: Kittens as listed in the front page
        Given I am on "/"
        Then I should see "Meow, World!"
        And I should see 9 cats out of 100 total cats