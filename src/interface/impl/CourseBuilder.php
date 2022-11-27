<?php

require_once( __DIR__ . "/../Builder.php" );
require_once( __DIR__ . "/../../entity/Course.php" );

use Builder\CourseBuilder as Builder;

class CourseBuilder implements Builder {
    private Course $course;

	private function __construct() {
		$this->course = new Course();
	}

	public static function init(): Builder {
		return new CourseBuilder();
	}

    public function build() : Course {
        return $this->course;
    }

    public function id ( $id ): CourseBuilder {
        $this->course->setId( $id );

        return $this;
    }

    public function title( $title ): CourseBuilder {
        $this->course->setTitle( $title );

        return $this;
    }

    public function videoLink($videoLink): CourseBuilder {
        $this->course->setVideoLink( $videoLink );

        return $this;
    }

    public function content( $content): CourseBuilder {
        $this->course->setContent( $content );

        return $this;
    }
}