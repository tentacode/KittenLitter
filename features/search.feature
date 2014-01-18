Feature: Searching kitten is some complex stuff

    Background:
        Given there is 49 male cats
        And there is 51 female cats

    Scenario: Using the quick search, I can search for kittens from the homepage
        Given I am on "/"
        And I use the quick search to find for "Blackie"
        Then I should see 4 cats

    Scenario Outline: In advanced search, I can filter cats by genders
        Given I am on the advanced search page
        When I search for cats that are "<gender>"
        Then I should see <visibleCats> cats out of <totalCats>

        Examples:
            | gender     | visibleCats | totalCats |
            | Any gender | 9           | 100       |
            | Male       | 9           | 49        |
            | Female     | 9           | 51        |

    Scenario Outline: If I filter by name and gender, both filters should be applied
        Given I am on the advanced search page
        When I search for cats that are "<gender>" and named "Blackie"
        Then <iShouldSeeKittens>

        Examples:
            | gender | iShouldSeeKittens         |
            | Male   | I should see 4 cats       |
            | Female | I should not see any cats |