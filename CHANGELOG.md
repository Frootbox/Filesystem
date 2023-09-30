# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [0.3] - 2023-09-30

### Added

- Added directory support to files. 

## [0.2] - 2023-07-16

### Changed

- Directory now returns File object on Iterators.
- File object return filename when converted to string to maintain compatibility.

## [0.1] - 2023-07-16

### Changed

- Renamed CHANGELOG to CHANGELOG.md

### Fixed

- Improved PHP 8.2 compatibility.

## [0.0.7]

### Added

- Added moving files.

### Fixed

- Removed old code block.

## [0.0.6]

### Fixed

- Improved file permissions handling.

## [0.0.5]

### Fixed

- Fixed deprecated syntax. 

## [0.0.4] - 2019-12-22

### Added

- Method File::delete()

### Fixed

- Reverse directory checking to avoid open_basedir restrictions.
- Traits\Directory only creates directories if not existent.
- Traits\Directory mutes warnings due to open_basedir restrictions.

## 0.0.3

### Added

- Method Directory::getPath()
- License information

## 0.0.2

### Added

- Traversing the directory

## 0.0.1

### Added

- Directory handling class
- File handling class
- Changelog