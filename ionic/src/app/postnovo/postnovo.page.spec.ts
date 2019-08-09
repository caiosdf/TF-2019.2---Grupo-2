import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PostnovoPage } from './postnovo.page';

describe('PostnovoPage', () => {
  let component: PostnovoPage;
  let fixture: ComponentFixture<PostnovoPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PostnovoPage ],
      schemas: [CUSTOM_ELEMENTS_SCHEMA],
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PostnovoPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
