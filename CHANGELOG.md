# Change Log
All notable changes to this project will be documented in this file.

## [Unreleased](https://github.com/RhodriM/graph/compare/1.6.2...master)
### Edited

## [1.6.1](https://github.com/RhodriM/graph/compare/1.6.0...1.6.2) - 2020-03-12
### Edited
 - Removed phpdocumentor as uses old version of symfony/dependency-injection
 - Fix to ensure edge properties that are floats are not cast to integers

## [1.6.1](https://github.com/RhodriM/graph/compare/1.6.0...1.6.1) - 2019-11-12
### Edited
 - Fixed reading graph attributes from gml file

## [1.6.0](https://github.com/RhodriM/graph/compare/1.5.1...1.6.0) - 2019-11-06
### Added
 - Add Stats class for general network properties
 - Add BalancedTreeDepth

## [1.5.1](https://github.com/RhodriM/graph/compare/1.5.0...1.5.1) - 2019-04-24
### Edited
 - Fixes to GML parser, should better handle GML files written by networkx

## [1.5.0](https://github.com/RhodriM/graph/compare/1.4.2...1.5.0) - 2018-08-24
### Added
 - Add clone methods to GraphContainer and Node

## [1.4.2](https://github.com/RhodriM/graph/compare/1.3.0...1.4.2) - 2018-07-30
### Added
 - Allow adding nodes with ids
 - GML Input
### Edited
 - Fixes to GML parser and GML output

## [1.3.0](https://github.com/RhodriM/graph/compare/1.2.0...1.3.0) - 2018-07-11
### Added
 - Added AllSimplePathsFromNode search

## [1.2.0](https://github.com/RhodriM/graph/compare/1.1.0...1.2.0) - 2018-07-10
### Added
 - Added findEdgeInOutList function to GraphContainer
 - Added Dijkstra shortest path

## [1.1.0](https://github.com/RhodriM/graph/compare/1.0.0...1.1.0) - 2018-05-22
### Added
 - Added Contributing guide
 - Added Issue Template
 - Added Breadth-first search
### Edited
 - Edited Readme
 

## [1.0.0](https://github.com/RhodriM/graph/compare/v0.6...1.0.0) - 2018-02-19
### Added
 - Added License
 - Added Readme
 - Added Code of Conduct
 - Added Changelog
 - Additional test coverage
### Fixed
 - Tidied code, comply with code standards and phpmd
 - improved composer.json
 - move to better version numbers (semantic versioning)

## [v0.6](https://github.com/RhodriM/graph/compare/v0.56...v0.6) - 2018-02-13
### Added
 - Added optional colour to nodes
 
## [v0.56](https://github.com/RhodriM/graph/compare/v0.55...v0.56) - 2018-02-13
### Fixed
 - ensure arrays are initialised in GraphContainer
 
## [v0.55](https://github.com/RhodriM/graph/compare/v0.5...v0.55) - 2018-02-12
### Added
 - allow adding edges by id
 
## 0.5 - 2018-02-11
- First tag
