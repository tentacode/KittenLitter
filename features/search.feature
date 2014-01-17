Feature: Searching kitten is some complex stuff

    Scenario: Using the quick search, I can search for kittens from the homepage
        Given I am on "/"
        And I use the quick search to find for "Pepper"
        Then I should see 7 cats